// JavaScript Document
function  CopyToClipboard()

{

   CopiedTxt = document.selection.createRange();

   CopiedTxt.execCommand("Copy");

}
