<?php
// PRIVATE CODE FOR SECURITY REASONS, Please contact one@viholder.com for any information.

  // IF IS SMART-CONTRACT: CREATE AND UPDATE WALLETS
        

            if (post('create-smartcontract')==1){  

                $walletID = (new WalletModel)->create([
                    'userID'  => logged('id'), 
                    'contractID'  => $contractID, 
                    'network'  => "ripple",
                ]);

                
                if (post('contract-network')=="ripple"){  
                    $rpc_url =  setting('server_xrp'); //"https://s.altnet.rippletest.net:51234"; 
                    $id = $contractID;  
                    $userID=logged('id'); // owner of the wllaet, userID or contractID
                    $idWallet=$walletID;
                    $command = escapeshellcmd("python3 ./xrp/create_wallet.py $rpc_url $id $userID $idWallet");
                    shell_exec($command);
                }

             }
             
 
         
