Message from: <? echo $customer['name']; ?> \n
Message from <? if ($user_type=='Customer'): echo 'Customer'; else: echo 'Merchant'; endif; ?> id: <? echo $customer['id']; ?>\n
Message reply-to Address: <? echo $customer['email']; ?>\n
Message text: <? echo $message; ?>\n