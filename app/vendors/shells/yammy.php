<?php
/**
 * YAMMY! is a CakePHP shell script that converts your DB table schema into a YAML schema
 *
 * Run 'cake yammy help' for more info and help on using this script.
 *
 * PHP versions 4 and 5
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2007-2008, Daniel Vecchiato
 * @link			http://www.4webby.com
 * @since			CakePHP(tm) v 1.2
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 * @version         1.0
 * 
 * 
 * DEPENDENCIES: download Spyc class (Yaml Parser) (http://spyc.sourceforge.net/)
 *               put spyc.php in your vendors folder
 */
class YammyShell extends Shell {

    var $_useDbConfig = 'default';
    
    var $_migrationTable = 'schema_info';
    
	function main() {
        
	    //let's initialize variables, constants etc.
	    $this->__initialize();
		
		//asks options
		$this->out('[S]ingle table');
		//$this->out('[M]ultiple tables');
		$this->out('[A]ll tables');
		$this->out('[Q]uit');

		$tablesToYammy = strtoupper($this->in('Which tables do you want to YAMMY?', array('S', 'A', 'Q')));
		switch($tablesToYammy) {
			case 'S':
			    $this->__execute();
			    break;
			case 'M':
			    
			case 'A':
				$this->all();
				break;
			case 'Q':
				exit(0);
				break;
			default:
				$this->out('You have made an invalid selection. Please choose what to do by entering S, A, or Q.');
		}
		$this->hr();
		
		//recursively calls main functionat the end of tasks execution
		$this->main();
	}
	
	// --------------------------------------------------------------------
	/**
	 * Initializes the YAMMY Shell
	 *
	 * @return unknown
	 */
	function __initialize()
	{
		//if we don't have an application YET let's build it
		if (!is_dir(CONFIGS)) {
			$this->Project->execute();
		}
        
		//if no db config is present let's set it
		if (!config('database')) {
			$this->out("Your database configuration was not found. Take a moment to create one.\n");
			$this->args = null;
			return $this->DbConfig->execute();
		}
		
		//let's define were migration file will be written
		if(!defined('MIGRATIONS_PATH')){
	        define('MIGRATIONS_PATH', APP_PATH .'config' .DS. 'migrations');
	    }
	}
	
	// -------------------------------------------------------------------- 
	/**
     * Execution method always used for tasks
     *
     * @return void
     */
	function __execute() {
		if (empty($this->args)) {
			$this->hr();
			$this->out('Bake a YAML file for CAKE migrations:');
			$this->hr();

			$useTable = null;

			//let's choose DB connection
			$dbIsGood =	$this->in('Use default database connection?', array('y','n'), 'y');
			if(low($dbIsGood) == 'n'){
			    $this->_useDbConfig = $this->in('Choose a database connection:', null, 'default');
			}

			$this->__interactive();
		}
	}
	
    /**
     * Handles interactive YAML files construction
     *
     * @access private
     * @return void
     */
	function __interactive() {
		
        
        $currentModelName = $this->_getName();
        
		$db =& ConnectionManager::getDataSource($this->_useDbConfig);
		$tableIsGood = false;
		$useTable = Inflector::tableize($currentModelName);
		$fullTableName = $db->fullTableName($useTable, false);
		if (array_search($useTable, $this->__tables) === false) {
			$this->out("\nGiven your model named '$currentModelName', Cake would expect a database table named '" . $fullTableName . "'.");
			$tableIsGood = $this->in('do you want to use this table?', array('y','n'), 'y');
		}

		if (low($tableIsGood) == 'n' || low($tableIsGood) == 'no') {
			$useTable = $this->in('What is the name of the table?');
		}
		while ($tableIsGood == false) {
			if (is_array($this->__tables) && !in_array($useTable, $this->__tables)) {
				$fullTableName = $db->fullTableName($useTable, false);
				$this->out($fullTableName . ' does not exist.');
				$useTable = $this->in('What is the name of the table?');
				$tableIsGood = false;
			} else {
				$tableIsGood = true;
			}
		}
		
		$this->out('');
		$this->hr();
		$this->out('The following Yaml Migration file will be created:');
		$this->hr();
		$this->out("DB Connection: " . $this->_useDbConfig);
		$this->out("DB Table:	" . $fullTableName);
		/*if ($primaryKey != 'id') {
			$this->out("Primary Key:   " . $primaryKey);
		}*/
        $looksGood = $this->in('do you want to use this table?', array('y','n'), 'y');
		if (low($looksGood) == 'y' || low($looksGood) == 'yes') {
			if ($useTable == Inflector::tableize($currentModelName)) {
				// set it to null...
				// putting $useTable in the model
				// is unnecessary.
				$useTable = null;
			}
			if ($this->__fireDB($fullTableName)) {
				$this->hr();
				$this->out('');
        		$this->out('Generation of migration file for table: \''.$fullTableName.'\' completed.');
        		$this->out('You can now edit it to customise your migration.');
        		$this->out('');
        		$this->hr();
        		$this->main();
			}
		} else {
			$this->out('YAMMY Aborted.');
		}
	}
	
	// --------------------------------------------------------------------
	/**
	 * Converts all tables of the DB in YAML format
	 * The generated file will be written in APP/config/migrations
	 *
	 * @return unknown
	 */
	function all()
	{
		$this->__initialize();
		
		//let's get an array with all tables in DB
		$this->_getTables();
		
		if(empty($this->__tables)){
		     $this->out('No tables in the database provided');
		     $this->out('Yammy Aborted.');
		     exit;
		}
		else{
		    $this->hr();
    		$this->out('Converting ALL db tables to YAML schema');
    		$this->hr();
    		$this->__fireDB($this->__tables, true);
		}
	}
	
	// --------------------------------------------------------------------
	/**
	 * Converts the provided tables SPACE separated into a YAML file
	 * The generated file will be written in APP/config/migrations
	 *
	 * @return unknown
	 */
	function tables()
	{
		$this->__initialize();
		
		$providedTables  = $this->args;
        
		//let's get an array with all tables in DB
		$this->_getTables();
		
		//empty database
		if(empty($this->__tables)){
		     $this->out('Database empty');
		     $this->out('Yammy Aborted.');
		     exit;
		}
		elseif(empty($providedTables) || $providedTables[0]==''){
		    $this->out('Please specify at least a table name!');
		    $this->out('Yammy Aborted.');
		    exit;
		}
		else{
		    //check if provided tables are in DB
		    foreach($providedTables as $val){
		        if(!in_array($val , $this->__tables)){
		           $this->out('Table '.$val.' not in DB');
    		       $this->out('Yammy Aborted.');
    		       exit; 
		        }
		    }
		    $this->hr();
    		$this->out('Converting tables to YAML schema');
    		$this->hr();
    		$this->__fireDB($providedTables, true);
		}
	}
	
	// --------------------------------------------------------------------
	/**
	 * Alias function for 'tables'
	 * Converts the provided tables SPACE separated into a YAML file
	 * The generated file will be written in APP/config/migrations
	 *
	 * @return unknown
	 */
	function t()
	{
		$this->tables();
	}
	
	// --------------------------------------------------------------------
	/**
	 * Burns the provided tables Schema into a YAML file suitable for migrations
	 *
	 * @param array $tables
	 * @return unknown
	 */
	function __fireDB($tables = null, $allTables = false)
	{
		$fileName = $allTables == true ? 'full_schema' : $tables;
		
		if(!is_array($tables)){
		    $tables = array($tables);
		}
		
		$__tables = $this->__filterMigrationTable($tables);
		
		if(empty($__tables)){
		    $this->out('No tables in the database provided apart from MIGRATIONs table');
		    $this->out('i.e. '.$this->_migrationTable);
		    $this->out('Yammy Aborted.');
		    exit;
		}
		
		$numTables = count($__tables);
		
		foreach($__tables as $__table){

		    //creating array for UP fields
		    $upSchema[$__table] = $this->__buildUpSchema($__table);

		}
		$__dbShema['UP']['create_table'] = $upSchema;

		//creating array for DOWN fields
		$__dbShema['DOWN']['drop_table'] = $__tables;

		//print file header
		$out ='#'."\n";
		$out.='# migration YAML file'."\n";
		$out.='#'."\n";
		$out.= $this->__toYaml($__dbShema);
		//get version number
		$this->_getMigrations();
		$new_migration_count = $this->_versionIt($this->migration_count+1);
		//write .yml file

		$fileName = MIGRATIONS_PATH.DS.$new_migration_count.'_'.$fileName.'.yml';
		return $this->createFile($fileName, $out);
	}
	
	// --------------------------------------------------------------------
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $name
	 * @param unknown_type $useTable
	 * @return array
	 */
	function __buildUpSchema($tableName) {

        $useTable = low(Inflector::pluralize($tableName));
        
        loadModel();        
        $tempModel = new Model(false, $tableName);
		$db =& ConnectionManager::getDataSource($this->_useDbConfig);
		$modelFields = $db->describe($tempModel);
		foreach($modelFields as $key=>$item){
		    if($key!='id' AND $key!='created' AND $key!='modified'){
		        $default = !empty($item['default']) ? $item['default'] : 'false';

		        $setNull = $item['null']==true ? 'is_null' : 'not_null';
		        
		        $tempFieldSchema[$key] = array('type'=>$item['type'],
		                                       'default'=>$default,
		                                       'length'=>$item['length'],
		                                      );
		        //let's set the option NULL field                             
		        $tempFieldSchema [$key][] = $setNull;
		        $tableSchema = $tempFieldSchema;		        
		    }
		}
		if(!array_key_exists('id', $modelFields)){
		    $tableSchema[] = 'no_id';
		}
		if(!array_key_exists('created', $modelFields)){
		    $tableSchema[] = 'no_dates';
		}
		
        return $tableSchema; 
	}
	
	// -------------------------------------------------------------------- 
	function data()
	{
		$this->__initialize();
		
		$providedTables  = $this->args;
        
		//let's get an array with all tables in DB
		$this->_getTables();
		
		//empty database
		if(empty($this->__tables)){
		     $this->out('Database empty');
		     $this->out('Yammy Aborted.');
		     exit;
		}
		elseif(empty($providedTables) || $providedTables[0]==''){
		    $this->out('Please specify at least a table name!');
		    $this->out('Yammy Aborted.');
		    exit;
		}
		else{
		    //check if provided tables are in DB
		    foreach($providedTables as $val){
		        if(!in_array($val , $this->__tables)){
		           $this->out('Table '.$val.' not in DB');
    		       $this->out('Yammy Aborted.');
    		       exit; 
		        }
		    }
		    $this->hr();
    		$this->out('Converting tables to YAML schema');
    		$this->hr();
    		$this->_buildData($providedTables);
		}
	}
	
	
	// --------------------------------------------------------------------
	/**
	 * Wrapper to use the Spyc class (Yaml Parser)
	 * You must have spyc (http://spyc.sourceforge.net/) in your vendors folder
	 *
	 * @param array $schema
	 * @return string
	 */
	function __toYaml($schema = null) {
	    //let's load Spyc
		vendor('spyc');
		//converting array to YAML
        $out = Spyc::YAMLDump($schema);
        return $out; 
	}
	
	// -------------------------------------------------------------------- 
	/**
     * Forces the user to specify the model he wants to bake, and returns the selected model name.
     *
     * @return the model name
     */
	function _getName() {
		$this->_listAll($this->_useDbConfig);

		$enteredModel = '';

		while ($enteredModel == '') {
			$enteredModel = $this->in('Enter a number from the list above, or type in the name of another model.');

			if ($enteredModel == '' || intval($enteredModel) > count($this->_modelNames)) {
				$this->out('Error:');
				$this->out("The model name you supplied was empty, or the number \nyou selected was not an option. Please try again.");
				$enteredModel = '';
			}
		}

		if (intval($enteredModel) > 0 && intval($enteredModel) <= count($this->_modelNames)) {
			$currentModelName = $this->_modelNames[intval($enteredModel) - 1];
		} else {
			$currentModelName = $enteredModel;
		}

		return $currentModelName;
	}
	
	// -------------------------------------------------------------------- 
	/**
    * outputs the a list of possible models or controllers from database
    *
    * @return output
    */
	function _listAll() {
		$this->_getTables();
		$this->out('');
		$this->out('Possible Models based on your current database:');
		$this->hr();
		$this->_modelNames = array();
		$count = count($this->__tables);
		for ($i = 0; $i < $count; $i++) {
			$this->_modelNames[] = $this->_modelName($this->__tables[$i]);
			$this->out($i + 1 . ". " . $this->_modelNames[$i]);
		}
	}
	
	// --------------------------------------------------------------------
	/**
	 * Get's the tables in DB according to your connection configuration
	 *
	 */
	function _getTables(){
	    $db =& ConnectionManager::getDataSource($this->_useDbConfig);
		$usePrefix = empty($db->config['prefix']) ? '' : $db->config['prefix'];
		if ($usePrefix) {
			$tables = array();
			foreach ($db->listSources() as $table) {
				if (!strncmp($table, $usePrefix, strlen($usePrefix))) {
					$tables[] = substr($table, strlen($usePrefix));
				}
			}
		} else {
			$tables = $db->listSources();
		}
		$this->__tables = $this->__filterMigrationTable($tables);
	}
	
	// -------------------------------------------------------------------- 
	/**
	 * Used to build migrations file numbers
	 * 
	 * @author Joel Moss
	 * @link http://joelmoss.info/
	 *
	 */
	function _getMigrations()
	{
	    $folder = new Folder(MIGRATIONS_PATH, true, 0777);
	    $this->migrations = $folder->find("[0-9]+_.+\.yml");
	    usort($this->migrations, array($this, '_upMigrations'));
	    $this->migration_count = count($this->migrations);
	}
	
	// -------------------------------------------------------------------- 
	/**
	 * Custom function used by usort in getMigrations
	 *
	 * @author Joel Moss
	 * @link http://joelmoss.info/
	 * @param unknown_type $a
	 * @param unknown_type $b
	 * @return unknown
	 */
	function _upMigrations($a, $b)
	{
		list($aStr) = explode('_', $a);
		list($bStr) = explode('_', $b);
		$aNum = (int)$aStr;
		$bNum = (int)$bStr;
		if ($aNum == $bNum) {
			return 0;
		}
		return ($aNum > $bNum) ? 1 : -1;
	}
	
    // -------------------------------------------------------------------- 
    /**
    * Converts migration number to a minimum three digit number.
    *
    * @param $num The number to convert
    * @return $num The converted three digit number
    * @author Joel Moss
    * @link http://joelmoss.info/
    */
    function _versionIt($num)
    {
        switch (strlen($num))
        {
            case 1:
                return '00'.$num;
            case 2:
                return '0'.$num;
            case 3:
                return $num;
        }
    }
    
    // -------------------------------------------------------------------- 
    function __filterMigrationTable($myTables)
    {
    	$mySchemaInfoKey = array_search($this->_migrationTable, $myTables);
        $filteredArray = Set::remove($myTables, $mySchemaInfoKey);
        sort($filteredArray);
    	return $filteredArray;
    }
    // -------------------------------------------------------------------- 
    /**
     * Displays help contents
     *
     * @return void
     */
	function help() {
	    $this->out('YAMMY! helps you write DB schema in a YAML format.');
	    $this->out('The generated files can then be used for DB migrations');
        $this->out('allowing you to migrate your database schema between versions.');
        $this->out('');
        $this->out('');
        $this->out('COMMAND LINE OPTIONS');
        $this->out('');
        $this->out('  cake yammy');
        $this->out('    - interactive YAML generation');
        $this->out('');
        $this->out('  cake yammy all');
        $this->out('    - generates YAML schema for all tables of default DB connection');
        $this->out('');
        $this->out('  cake yammy tables [table1_name] [table2_name]');
        $this->out('    - Generates a YAML schema for all tables supplied [migration name]');
        $this->out('      table names must be SPACE SEPARATED');
        $this->out('');
        $this->out('  cake yammy help');
        $this->out('    - Displays this Help');
        $this->out('');
        $this->out('  cake yammy h');
        $this->out('    - alias for help');
        $this->out('');
        $this->out('  cake yammy t');
        $this->out('    - alias for tables');
        $this->out('');
        $this->out('');
        $this->out('For more information and for the latest release of this and others,');
        $this->out('go to http://www.4webby.com');
        $this->out('');
        $this->hr();
        $this->out('');
	    exit();
	}
    
	// --------------------------------------------------------------------
	/**
	 * Alias function for 'help'
	 *
	 */
	function h(){
	    $this->help();
	}
    
	// --------------------------------------------------------------------
	/**
	 * Prints intro
	 *
	 */
	function _welcome()
	{
	    $this->out(' __  __  _  _  __    _   _  __   _  _   _  _  _   _');
	    $this->out('|   |__| |_/  |__     \ /  |__| | \/ | | \/ |  \ / ');
	    $this->out('|__ |  | | \_ |__      |   |  | |    | |    |   |  ');
	    $this->out('');
	    $this->out('burn your SQL to YAML faster!');
	    $this->hr();
	    $this->out('Welcome to YAMMY!');
	    $this->out('by Daniel Vecchiato www.4webby.com');
	    $this->hr();
	}
}
?>