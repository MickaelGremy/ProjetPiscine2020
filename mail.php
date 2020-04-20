<?php
    
    //session_start();
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=piscine2020', 'root', '');
    if(isset($_GET['idacht']))
    {  
        $idacheteur = $_GET['idacht'];
        
        
        $verifpanier = $bdd->prepare("SELECT * FROM panier WHERE idAcheteur = ?");
        $verifpanier->execute(array($idacheteur));
    
        header('Location: confirmerCommande.php?id='.$idacheteur);
   
    
        $verifuser = $bdd->prepare('SELECT * FROM acheteur WHERE id = ?');
        $verifuser->execute(array($_GET['idacht']));
        $userinfo = $verifuser->fetch();
        
        $sommepanier = $bdd->prepare('SELECT SUM(Prix) AS Somme FROM panier WHERE idAcheteur = ?');
        $sommepanier->execute(array($_GET['idacht']));
        $affichertotal = $sommepanier->fetch();

        $header="MIME-Version : 1.0\r\n";
        $header.='From:"EbayECE"<commande@ebayece.com>'."\n";
        $header.='Content-TYpe:text/html; charset="utf-8"'."\n";
        $header.='Content-Transfer-Encoding: 8bit';
        $dateP = "27-04-2020";//  ici ta date
        $date = date('d-m-Y', strtotime($dateP. ' + 7 days'));
        

    $message = '
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<head>
<title>Mobile Responsive Email</title>

<style type="text/css">
.ReadMsgBody {width: 100%;}
.ExternalClass {width: 100%;}
.mobile {display: none;overflow: hidden;visibility:hidden;}
strong{font-weight: bold;}

	@media only screen and (max-width: 479px){ /**change to max-device-width after testing**/
		
	     td[class="desktop"], table[class="desktop"] {
	         display: none !important;
	     }
     	
		 td[class="mobile_only"], table[class="mobile_only"], img[class="mobile_only"], div[class="mobile_only"], tr[class="mobile_only"] {
			display: block !important;
 			width: auto !important;
  			overflow: visible !important;
			height: auto !important;
			max-height: inherit !important;
			font-size: 15px !important;
			line-height: 21px !important;
			visibility: visible !important;
	     }		 
		 
		 img[class="mobile_header"] { 
		 	width: 320px !important;
			height: 243px !important;
			display: block !important; 			
  			overflow: visible !important;
			visibility: visible !important;}
		 
		 td[class="full_width"], table[class="full_width"] {
	          width: 320px !important;
	     }
	    
		 td[class="medium_width"], table[class="medium_width"] {
	          width: 272px !important;
	     }
		 	 
		 td[class="intro_text"], table[class="intro_text"] {
	     	font-size: 14px !important;
			line-height: 20px !important;
	     }
		
	}
</style>

</head>

<body bgcolor="#f5f5f5" style="background-color:#f5f5f5; margin:0; padding:0;-webkit-font-smoothing: antialiased;width:100% !important;-webkit-text-size-adjust:none;" topmargin="0"><div style="font-size: 1px; color: #f5f5f5; display: none;">Short description appears as email content preview.</div>
  
  <!--spacer-->
    
     <table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>  
           <td height="24" style="font-size: 0px; line-height: 0px;">&nbsp;</td>
        </tr>
     </table>



<!-- wrapper table-->
<table width="100%" bgcolor="#f5f5f5" style="background-color:#f5f5f5;" border="0" cellpadding="0" cellspacing="0">
  <tr>
	<td>&nbsp;</td>

    <td class="full_width" width="650" align="center" style="border-left:1px solid #d8d8d8; border-right:1px solid #d8d8d8; border-bottom:1px solid #d8d8d8; border-top:1px solid #d8d8d8;background-color: #ffffff; padding-bottom: 30px;">
      
 
    
    <!--spacer-->
    
     <table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>  
           <td height="24" style="font-size: 0px; line-height: 0px;">&nbsp;</td>
        </tr>
     </table>
      
      
     <!-- optional use of scene7 for headline -->
 
    	<table align="center" width="100%" border="0" cellpadding="0" cellspacing="0" style="padding-top: 12px;">
         <tr>              
           <td class="desktop" style="padding-bottom:8px;margin-right:250px;margin-left:250px;"><img alt="Software Name Here in Adobe Clean" src="https://cdn.website-editor.net/a75fcef7b3db4a32b628ad0ebc258835/dms3rep/multi/cheque.svg" align="center" width="200" height="auto" vspace="0" hspace="0" border="0" style="display:block; vertical-align:top;"></td>        
         </tr>
     	</table>   
     
 
       
      
       <!--spacer-->
    
     <table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>  
           <td height="24" style="font-size: 0px; line-height: 0px;">&nbsp;</td>
        </tr>
     </table>
     
 
      <table class="medium_width" align="center" width="380" border="0" cellpadding="0" cellspacing="0">
      </table>   
      
      
    
    <!-- headline-->
    
     <table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">      
       <tr>
          <td class="desktop" width="42">&nbsp;</td>
          <td class="intro_text" style="color:#333333; font-family: Helvetica, sans-serif;text-align:left; font-size:18px; line-height:22px;">
            <center> &mdash; Votre commande est confirmée '.$userinfo['Prenom'].' ! &mdash; </center>
          </td>
          <td width="24">&nbsp;</td>    
          <td class="desktop" width="42">&nbsp;</td>
        </tr>
     </table>
      
     <!--spacer-->
      
      <table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>  
           <td height="24" style="font-size: 0px; line-height: 0px;">&nbsp;</td>
        </tr>
      </table>
      
      <!--spacer-->
      
      <table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>  
           <td height="24" style="font-size: 0px; line-height: 0px;">&nbsp;</td>
        </tr>
      </table>
      
       <!-- headline-->
       
    
            
     <table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">      
       <tr>
          <td class="desktop" width="42">&nbsp;</td>
          <td class="intro_text" style="color:#333333; font-family: Helvetica, sans-serif;text-align:left; font-size:18px; line-height:22px;">
            Vous avez commandé :<br><br>
            ';
        
        while($data = $verifpanier->fetch())
        {
            $message .= '
        
            '.$data['Nom'].' au prix de ('.$data['Prix'].'€) <br>
                
                ';
        }
        
        
        
        $message .='
        
          </td>
          <td width="24">&nbsp;</td>
          <td class="desktop" width="42">&nbsp;</td>
        </tr>
     </table>
      
      <!--spacer-->
      
      <table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>  
           <td height="24" style="font-size: 0px; line-height: 0px;">&nbsp;</td>
        </tr>
      </table>
      
      
       <!-- bottom column-->
           
    	<table class="medium_width" align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
         <tr>      
          <td class="desktop" width="67" style="padding-top:18px;">&nbsp;</td>
          <td style="border-top: 1px solid #d9d9d9; color:#333333; font-family: Helvetica, sans-serif;text-align:left; font-size:14px; line-height:20px; padding-top:18px; padding-bottom:18px;">
            <strong>Total de votre commande : </strong>
            
        
            '.$affichertotal['Somme'].'€ <br> <i>Vous avez réglé par carte bancaire</i>
            <br>
            <br>
            Le délais de livraison est estimé à 7 jours en raison des conditons sanitaires actuelles. <br>
            
            
            
            Votre commande arrivera à partir du '.$date.' entre 13h et 19h.
            <br> A très bientôt !
            
       
          </td>          
         <td class="desktop" width="34" style="border-top: 1px solid #d9d9d9;padding-top:18px;">&nbsp;</td>
         <td class="desktop" style="border-top: 1px solid #d9d9d9; padding-top:18px; padding-bottom:18px;"><img alt="Image4" src="https://bestcourses.fr/wp-content/uploads/2020/04/EbayECE.png" width="100" height="83" border="0" hspace="0" vspace="0" style="display:block; vertical-align:top;text-align:right"></td>
         <td class="desktop" width="67" style="padding-top:18px;">&nbsp;</td>
        </tr>
     	</table>   
        
      <!-- social media links -->  
           
      <table class="medium_width" align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>      
          <td class="desktop" width="67" style="padding-top:12px;">&nbsp;</td> 
          <td align="right" valign="top" style="border-top:1px solid #d9d9d9; padding-top:12px;">
          		<table width="200" border="0" cellpadding="0" cellspacing="0">
                 <tr>
                    <td style="color:#333333; font-family: Helvetica, sans-serif;text-align:right; font-size:13px; line-height:15px;">Ebay ECE &copy;</td>
                    
                        
                   </td>
                 </tr>
              </table>
          </td>
          <td class="desktop" width="67" style="padding-top:12px;">&nbsp;</td>             
        </tr>
      </table>
      
    </td>
    <td>&nbsp;</td>
  </tr>
</table> <!--/end wrapper-->
  
  
<!-- legal disclaimer -->  
  
<table class="full_width" bgcolor="#f5f5f5" align="center" width="650" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td class="desktop" width="22">&nbsp;</td>
    <td align="center" style="color:#a1a1a1; font-family: Helvetica, sans-serif;text-align:left; font-size:11px; line-height:13px; text-align:left; padding-top:20px; padding-bottom:40px;">Ebay ECE Inc, All rights reserved</td>
    <td class="desktop" width="22">&nbsp;</td>
  </tr>
</table>

</body>
</html>

    ';
    

    mail($userinfo['Email'], "Confirmation de votre commande", $message, $header);
    
    }
    
?>
