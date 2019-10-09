<?php
// Remove this PHP code if you don't want to have any server side stats tracking.
session_start();
?>
<!doctype html>
<!--

MOSQUITO wants its sweet, sweet data

                //\
               || |
               || |
               |  |
          ______\/_  ,
         '||||||'  (o)
         `------'--  \
                /|\   \
                       \
                       
-->
<html class="no-js" lang="">
<head>
  <meta charset="utf-8">
  <title>Obtenir mes infos</title>
  <meta name="description" content="En vertu des lois canadiennes sur la protection de la vie privée, les organisations doivent vous donner accès à vos renseignements personnels lorsque vous en faites la demande. Nous pouvons vous aider à faire une telle demande.">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Place favicon.ico in the root directory -->

  <link rel="stylesheet" href="css/tachyons.min.css">
  <link rel="stylesheet" href="css/main.css">
</head>

<body class="sans-serif">
  <!-- This warning will display if the site is not served securely -->
  <div class="bg-red white pa4 tc dn" id="securityWarning">This is an insecure web server. Access My Info should only be hosted using HTTPS.</div>
  <!--[if lt IE 11]>
    <div class="bg-orange white pa4 tc dn">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</div>
  <![endif]

  <!-- Add your site or application content here -->

<header class="navbar bg-blue clearfix relative pv3">
  <div class="container center tc">
    <h1 class="ph1 mb0 mt1"><span>
        <!-- ADD YOUR LOGO HERE -->
        <img class="w10 width-titleimage-ns mw-100 w5-ns w4 mb1" alt="Obtenirs Mes Infos Logo" src="img/logo.png">
    </span></h1>
    <div>
  </div>
  <div class="absolute top-1 right-1">
    <a class="btn btn-primary f7" href="index.php">English</a>
  </div>
</header>

<!-- 
****************************************************
***  
***  This area is the top level stage navigation menu
***  It is controlled in stages.js
***  Feel free to fiddle around with the colours assigned
***  to children of #stageNav in styles/main.css
***  
****************************************************

 -->
  <nav>
    <ol class="flex list w-70-ns w-100 center mt3 mb4 pa0 items-stretch" id="stageNav">
      <li class="flex items-stretch">
        <a id="nav_el_industry" class="pv2 ph4 active flex items-center justify-center">
          <span class="db dn-ns">1</span>
          <span class="dn di-ns">Début</span>
        </a>
      </li>
      <li class="flex items-stretch">
        <a id="nav_el_company" class="pv2 ph4 active flex items-center justify-center">
          <span class="db dn-ns">2</span>
          <span class="dn di-ns">Entreprise</span>
        </a>
      </li>
      <li class="flex items-stretch">
        <a id="nav_el_information" class="pv2 ph4 active flex items-center justify-center">
          <span class="db dn-ns">3</span>
          <span class="dn di-ns">Données</span>
        </a>
      </li>
      <li class="flex items-stretch">
        <a id="nav_el_identifiers" class="pv2 ph4 active flex items-center justify-center">
          <span class="db dn-ns">4</span>
          <span class="dn di-ns">Coordonnées</span>
        </a>
      </li>
      <li class="flex items-stretch">
        <a id="nav_el_request" class="pv2 ph4 active flex items-center justify-center">
          <span class="db dn-ns">5</span>
          <span class="dn di-ns">Demande</span>
        </a>
      </li>
    </ol>
  </nav>

<div class="container center">
<!-- 
****************************************************
***  
***  This is the industry stage. 
***  Change the text and add elements and classes
***  for everything that's not a template, you can do whatever you want
***  except change IDs or delete elements with IDs. That might break things.
***  
****************************************************
 -->
  <section id="stage_industry" class="dn">
    <h2 class="tc">Bienvenue sur Obtenir mes infos</h2>
  <p class="lh-copy">Que savent les entreprises à votre sujet? Quelles informations conservent-ils? Avec qui partagent-ils ces informations? En vertu des lois canadiennes sur la protection de la vie privée, les organisations doivent vous donner accès à vos renseignements personnels lorsque vous en faites la demande. Nous pouvons vous aider à faire une telle demande.</p>
   <!-- This paragraph must be deleted if stats aren't enabled. It shows how many requests have been generated. -->
  <p class="f4 tc">Les Canadiens ont généré <strong><?php require_once('../stats/get_count.php');?></strong> demandes à l'aide de cet outil.</p>
    <div class="bg-light-gray pa3 mt4">
        <p class="f6 b tc">Demande d'accès à :</p>
        <ul id="industry" class="pa0">  
        <!-- 
        ****************************************************
        ***  
        ***  Below you will see the first sighting of
        ***      ami_template_id
        ***  This attriubute means that everything *inside*
        ***  the element will be treated as a template by the
        ***  template engine. Each stage's controller uses
        ***  these templates to feed live data into
        ***
        ***  Feel free to alter the classes associated with
        ***  the templates to hange their appearance.
        ***
        ***  do not remove elements or change IDs without
        ***  updating the app code accordingly
        ***  
        ****************************************************
        -->
        <li ami_template_id="industry_select_template" class="flex items-center bg-white height-xlarger btn-select btn">
          <div class="flexgrow-1 tc" style="min-width: 5rem">            
            <!-- 
            ****************************************************
            ***  
            ***  Next up you will see the
            ***     ami_template_image_container
            ***  THis is a sub-component of the template.
            ***  It tells the app's template engine to set
            ***  the image's SRC attribute to the a
            ***  property of the object passed to the template
            ***  in the controller
            ***  In this case, the "icon" property is looked for
            ***  In the controller, this is the industry.icon,
            ***  which correspods to the value you give an industry's icon
            ***  in data.js
            ***  again feel free to change the classes or the alt text
            ***  
            ****************************************************
             -->
            <img src="" ami_template_image_container="icon" class="mr3 w3 h3" alt="Industry icon"/>
          </div>
          <div class="flexgrow-2 tl-ns">        
            <!-- 
            ****************************************************
            ***  
            ***  Next we have
            ***     ami_template_value_container
            ***  It does basically the same thing as the image container
            ***  but instead of setting an src value, it sets the text
            ***  content of the element.
            ***  so, in this case, we have the id of the industry being
            ***  set in.
            ***  
            ****************************************************
             -->
            <div class="dn" ami_template_value_container="id"></div>
            <!-- Next we have the industry name -->
            <h1 ami_template_value_container="name" class="f5 mt0 mb2">Industry Name</h1>
            <!-- And now the description of the industry, as defined in data.js -->
            <div ami_template_value_container="description" class="f6 lh-solid">Industry Description</div>
          </div>
        </li>
      </ul>
      <p class="tc f6">Vous pouvez faire plusieurs demandes d'accès avec notre site web (mais une seule à la fois!).</p>
    </div>
  </section>

<!-- 
****************************************************
***  
***  This is the company stage. 
***  It is functionally pretty much the same as the industry stage
***  
****************************************************
 -->
  <section id="stage_company" class="dn">
    <h2 class="tc ph2 ph0-ns">Sélectionnez votre fournisseur de service</h2>
    <p class="lh-copy ph2 ph0-ns"><strong>Commencez votre demande d'accès</strong> en sélectionnant une organisation qui vous fournit un service.</p>
    <div class="bg-light-gray pa3">
      <ul id="company" class="pa0">
        <!-- template for an individual company listing. feel free to change classes around if you want to alter look and feel -->
        <li ami_template_id="company_select_template" class="flex items-center bg-white btn-select btn">
          <div class="flexgrow-1 h3 items-center flex" style="min-width: 5rem">
            <!-- Company logo here -->
            <img src="" ami_template_image_container="logo" class="mr3 mxh-4 mw4" alt="Company icon"/>
          </div>
          <div class="flexgrow-2">
            <!-- Company ID -->
            <div class="dn" ami_template_value_container="id"></div>
            <!-- Company name -->
            <h1 ami_template_value_container="name" class="f5 mt0 mb0 tr">Company Name</h1>
          </div>
        </li>
      </ul>
    </div>
    <div class="cf">
        <p><a id="custom_toggle" class="dark-red pointer"><strong>Aide :</strong> L'entreprise à laquelle je veux présenter une demande d'accès n'est pas dans la liste</a></p>
        <!----><form class="dn" id="custom_form">
         <div class="bg-light-gray pa3 mt2">
          <h3 class="mt0">Ajouter une autre entreprise</h3>
          <label class="form-item">
            Nom de l'entreprise<input type="text" name="custom_name">
          </label>
          <fieldset>
          <legend translate="customCompany.contactOverview">Personne responsable de la protection de la vie privée dans cette entreprise</legend>
          <p>Veuillez fournir les coordonnées de la personne responsable qui, dans cette entreprise, a la tâche  d'interagir avec le public à propos des questions relatives à la protection de la vie privée. Habituellement, cette information se trouve dans la politique de confidentialité de l'entreprise.</p>
          <p><strong>Veuillez fournir une adresse postale ou une adresse courriel.</strong></p>
          <label class="form-item">
            Titre :<input type="text" name="custom_title"></label>
          <label class="form-item">
            Courriel :<input type="text" name="custom_email"></label>
          <label class="form-item">
            Adresse 1<input type="text" name="custom_address_1"></label>
          <label class="form-item">
            Adresse 2<input type="text" name="custom_address_2"></label>
          <label class="form-item">
            Ville<input type="text" name="custom_city"></label>
          <label class="form-item">
            Province / État<input type="text" name="custom_province"></label>
          <label class="form-item">
            Code postal / Code ZIP <input type="text" name="custom_postal_code"></label>
          <label class="form-item">
            Pays<input type="text" name="custom_country"></label>
          </fieldset>
          </div>
        </form><!---->
      </div>
                <div class="cf mt2">
        <button class="btn btn-previous fl" id="back_el_company">Précédent</button>
        <button class="btn fr" id="next_el_company">Suivant</button>
      </div>
  </section>

<!-- 
****************************************************
***  
***  This is the information categories stage. 
***  Here users select the types of information they will
***  want to request from the organization.
***  
****************************************************
 -->
  <section id="stage_information" class="dn">
    <h2 class="tc ph2 ph0-ns">Quelles sont les données auxquelles vous voulez avoir accès?</h2>
    <p class="lh-copy ph2 ph0-ns">Apprenez comment vos données sont recueillies, utilisées, partagées et conservées.</p>
    <div class="bg-light-gray pv3 ph4">
      <!-- Selected company name template and value container -->
      <h3>Données demandées de <span id="information_company_name"><span ami_template_id="info_company_template"><span ami_template_value_container="name">Org</span></span></span></h3>
      <span class="note f4">Cette liste se veut exhaustive.
        <strong>
          <!-- The below span id is a hack, and the content gets replaced with JS... I got lazy and didn't register a full template for it. -->
          <span id="information_company_name2">Org</span> 
        ne détient peut-être pas certains de ces éléments.</strong>.</span>
      <form id="info_categories" class="mt4">
        <!-- Template for each information category -->
        <div ami_template_id="info_category_select_template">
          <div class="cf mb3">
            <!-- Put the info category id in a hiddne element -->
            <div class="dn" ami_template_value_container="id"></div>
            <label c>
              <span class="w-10 tc fl">
                <!-- Checkbox... very important to keep in the template -->
                <input type="checkbox" checked="true" value="id"/></span>
              <span class="w-80 f6 black fl">
                <!-- Name of the info category -->
                <span ami_template_value_container="name" class="b">Info Category Name</span>
                <!-- Description -->
                <span ami_template_value_container="description">Info Category Description</span>
              </span>
            </label>
          </div>
        </div>
      </form>
      <div class="cf">
        <button class="btn btn-previous fl" id="back_el_information">Précédent</button>
        <div class="fr" id="info_category_select_button">
          <button class="btn" ami_template_id="info_category_select_button_template">
            <span>Suivant</span>
          </button>
        </div>
      </div>
      
    </div>
  </section>

<!-- 
****************************************************
***  
***  This is the personal identifiers stage. 
***  Here users input their personal details so
***  the organization can identify them in their records
***  
****************************************************
 -->
 <section id="stage_identifiers" class="dn">
    <h2 class="tc ph2 ph0-ns">Vos coordonnées</h2>
    <p class="lh-copy ph2 ph0-ns">Entrez vos renseignements personnels pour que<span id="identifiers_company_name">
      <!-- Company name here -->
      <span ami_template_id="identifiers_company_template">
        <span ami_template_value_container="name">Org</span>
      </span>
    </span> puisse vous identifier dans ses archives.
  </p>
    <p class="lh-copy ph2 ph0-ns b">Obtenir mes infos ne recueillera pas ou n'enregistrera pas les renseignements personnels ci-dessous.</p>
    <div class="bg-light-gray pa4">
      <form id="personal_identifiers">
        <!-- each personal identifier associated with the selected industry in data.js gets added here as an input or select element -->
        <div ami_template_id="personal_identifiers_template">
          <div class="mb2">
            <!-- hidden identifier id -->
            <div class="dn" ami_template_value_container="id"></div>
            <label>
              <!-- name for the identifier category -->
              <span ami_template_value_container="name">ID Category Name</span>
              <!-- If identifier data object per data.js has options param set, this input will be replaced by SELECT element -->
            <input name=""/>
            </label>
          </div>
        </div>
      </form>
      <!-- Opt out checkbox. keep dn class there. it gets removed if stats are enabled -->
      <div id="optout_container" class="dn">
        <hr class="mv3"/>
        <p>Je consens et j'autorise :</p>
        <div class="ml2 mt3 mb4">
        <label><input type="checkbox" id="optout" class="mr1"/>{{YOUR ORG}} pourrait recueillir des informations à propos des organisations auxquelles j'ai fait une demande d'accès, cela à des fins statistiques.</label>
        </div>
      </div>
      <div class="cf">
        <button class="btn btn-previous fl" id="back_el_identifiers">Précédent</button>
        <div class="fr" id="personal_identifiers_button">
          <button class="btn" ami_template_id="personal_identifiers_button_template">
            <span>Suivant</span>
          </button>
        </div>
      </div>
    </div>
  </section>

<!-- 
****************************************************
***  
***  This is the final, request stage. 
***  It's the most complicated one!
***  It shows the request letter and gives the user
***  options for sending the letter (post or email)
***  
****************************************************
 -->
  <section id="stage_request" class="dn">
    <!-- intro text -->
    <h2 class="tc ph2 ph0-ns">Votre demande d'accès est prête</h2>
    <p class="lh-copy ph2 ph0-ns">Votre lettre à <span id="request_company_name">
      <!-- Company name -->
      <span ami_template_id="request_company_template"><span ami_template_value_container="name">Org</span>
    </span></span> a été générée par notre système.</p>
    <p class="lh-copy ph2 ph0-ns b">Relisez attentivement la lettre et suivez ensuite les instructions ci-dessous.</p>

    <!-- BELOW IS THE REQUEST LETTER -->
    <div class="bg-light-gray pa2">
    <div class="pa2 f6 bg-white" id="request">
      <!-- Date of the request -->
      <div id="request_date">
        <p ami_template_id="request_date_template">
          <span ami_template_value_container="date">today</span>
        </p>
      </div>
      <!-- Company contact info, andmailing address, if present for the company in data.js. See the vaue of each conditional attribute to see what should be in the data.js entry. conditional means it won't appear if the property is missing or has no value. So address2 isn't necessary to define, for example, if not needed. -->
      <div id="request_company_contact">
      <div ami_template_id="request_company_contact_template">
        <div><span ami_template_value_container_conditional="title">
          Privacy Officer
        </span></div>
        <div><span ami_template_value_container_conditional="address1">
          Privacy Officer
        </span></div>
        <div><span ami_template_value_container_conditional="address2">
          Privacy Officer
        </span></div>
        <div><span ami_template_value_container_conditional="city">
          Privacy Officer
        </span></div>
        <div><span ami_template_value_container_conditional="region">
          Privacy Officer
        </span></div>
        <div><span ami_template_value_container_conditional="postal_code">
          Privacy Officer
        </span></div>
        <div><span ami_template_value_container_conditional="country">
          Privacy Officer
        </span></div>
        </div>
      </div>
      <!-- THis stuff can be customized if needed -->
      <p>I am a user of your <span id="request_industry_name"><span ami_template_id="request_industry_name_template"><span ami_template_value_container="industry_name">telecommunications</span></span></span> service, and am interested in both learning more about your data management practices and about the kinds of personal information that you maintain and retain about me. So this is a request to access my personal data under’ Principle 4.9 of Schedule 1 and section 8 Canada’s federal privacy legislation, the Personal Information Protection and Electronic Documents Act (PIPEDA).</p>

      <p>I am requesting a copy of all records which contain my personal information from your organization.</p>

      <p>The following is a non-exclusive listing of all information that your organization may hold about me, including the following:</p>

      <!-- Dump all the info categories the user selected here in a list -->
      <ul id="request_information_categories">
        <li ami_template_id="request_information_category_template">
          <span ami_template_value_container_conditional="name">Info Category Name</span>: 
          <span ami_template_value_container_conditional="description">Info Category Description</span>
        </li>
      </ul>

      <!-- Customize as needed -->
      <p>If your organization has other information in addition to these items, I formally request access to that as well. If your service includes a data export tool, please direct me to it, and ensure that in your response to this letter, you provide all information associated with me that is not included in the output of this tool. Please ensure that you include all information that is directly associated with my name, phone number, e-mail, or account number, as well as any other account identifiers that your company may associate with my personal information.</p>

      <p>You are obligated to provide copies at a free or minimal cost within thirty (30) days in receipt of this message. If you choose to deny this request, you must provide a valid reason for doing so under Canada’s PIPEDA. Ignoring a written request is the same as refusing access. See the guide from the Office of the Privacy Commissioner at: http://www.priv.gc.ca/information/guide_e.asp#014. The Commissioner is an independent oversight body that handles privacy complaints from the public.</p>

      <p>Please let me know if your organization requires additional information from me before proceeding with my request.</p>

      <p>Here is information that may help you identify my records:</p>
      
      <!-- completed personal identifiers dumped here in a list -->
      <ul id="request_personal_identifiers">
        <li ami_template_id="request_personal_identifier_template">
          <span ami_template_value_container="name">Info Category Name</span>: 
          <span ami_template_value_container="value">Info Category Description</span>
        </li>
      </ul>

      <p>Sincerely,</p>
      <!-- Users's first and last name, if included -->
      <p id="request_signature">
          <span ami_template_id="request_signature_template">
            <span ami_template_value_container_conditional="firstname">Information Category</span> <span ami_template_value_container_conditional="lastname">Information Category</span>
          </span>
      </p>
</div>
</div>
<!-- END OF LETTER -->

<!-- BEGIN LETTER SEND OPTIONS -->
<h2 class="tc ph2 ph0-ns" id="method_title_both">Comment voulez-vous envoyer votre lettre?</h2>
<h2 class="tc ph2 ph0-ns" id="method_title_mail_only">Cette entreprise n'accepte actuellement que les demandes par courrier postal.</h2>
<div id="mail_method">
  <h3>Courrier postal</h3>
  <div class="bg-light-gray pa4 f5">
    <p>Utilisez le bouton ci-dessous pour créer un fichier PDF de votre lettre. Faites-la imprimer et postez-la à :</p>
    <div id="request_mailing_address">
      <!-- Print out the company contact info again -->
      <address class="f6 pl2 bl bw2 b--white mb2 lh-solid" ami_template_id="request_company_address_template">
          <span class="db" ami_template_value_container_conditional="title">
            Privacy Officer
          </span>
          <span class="db" ami_template_value_container_conditional="address1">
            Privacy Officer
          </span>
          <span class="db" ami_template_value_container_conditional="address2">
            Privacy Officer
          </span>
          <span class="db" ami_template_value_container_conditional="city">
            Privacy Officer
          </span>
          <span class="db" ami_template_value_container_conditional="region">
            Privacy Officer
          </span>
          <span class="db" ami_template_value_container_conditional="postal_code">
            Privacy Officer
          </span>
          <span class="db" ami_template_value_container_conditional="country">
            Privacy Officer
          </span>
        </span></address>
      </address>
    </div>
    <!-- Very important button to generate PDF. Feel free to change text or classess, but not IDs or tag names -->
    <div id="request_pdf_button">
      <button class="mt2 btn btn-primary" ami_template_id="request_pdf_button_template">
        <span>Créer une lettre en format PDF</span>
      </button>
    </div>
  </div>
</div>
<h2 class="tc ph2 ph0-ns" id="method_title_email_only">Cette entreprise n'accepte actuellement que les demandes par courriel.</h2>
<div id="email_method">
  <h3>Courriel</h3>
  <div class="bg-light-gray pa4 f5">
    <div>
        <!-- Don't mess with the IDS, but this is used for email send option. Feel free to adjust classes, as usual -->
      <h3>Suivez ces cinq étapes faciles pour expédier votre courriel : </h3>
      <ol id="email_instructions">
      <li class="flex w-100 pb4 mb2">
        <div class="pl3 w-70">
          Copiez votre lettre de demande dans le presse-papier de votre système.
        </div>
        <div class="w-30 tr">
          <button id="request_copy_button" class="btn btn-primary f6">Cliquez pour copier</button>
        </div>
      </li>
      <li class="flex w-100  pv4 mv2 bt b-black">
        <div class="pl3 w-40">
          Ouvrez votre logiciel de courriel.
        </div>
        <div class="w-60 tr">
          <div class="dib mb3" id="request_email_button">
          <a class="btn btn-primary f6" ami_template_id="request_email_button_template">
            <span>appli de courriel par défaut</span>
          </a>
        </div>
          <div class="dib" id="request_gmail_button">
          <a class="btn btn-primary f6" ami_template_id="request_gmail_button_template" target="blank">
            <span>Ouvrir Gmail</span>
          </a>
        </div>
      </div>
    </li>
      <li class="flex w-100 pv4 mv2 bt b-black">
        <div class="pl3 w-50">Révisez les champs <em>Destinataire</em> et <em>Objet</em>.</div>
        <div class="w-50 f6 bg-white ml2 pa2">
        <strong>Destinaire: </strong>    <span id="request_email_address">
      <!-- Print out email address of the org -->
      <address class="di" ami_template_id="request_company_email_template">
          <span ami_template_value_container="email">
            Privacy Officer</span>
      </address>
      </span>
      <span class="db mt2">
        <strong>Object: </strong>Requête formelle d’accès à mes renseignements personnels
      </span>
      </div>
      </li>
      <li class="pv4 mv2 bt b-black"><div class="pl3">Collez la lettre là où le contenu du courriel devrait se trouver.</div></li>
      <li class="pt4 mt2 pb2 bt b-black"><div class="pl3">Expédiez votre message!</div></li>
    </ol>
</div>
<div class="cf">
  <button class="btn btn-previous fl mt2" id="back_el_request">Précédent</button>
</div>

<p class="b lh-copy">C'est tout! Merci d'avoir participé au projet Obtenir mes infos.</p>
<p class="">Faites connaître notre projet :</p>

<!-- 
****************************************************
***  
***  Share buttons below
*** Adjust the references to accessmyinfo.org
***  and the share text.
*** everything must be urlencoded.
*** this tool helps that: https://meyerweb.com/eric/tools/dencoder/
***  
****************************************************
 -->
<div class="mv3 ph1 ph0-ns">
    <a class="btn btn-social dib fill-white pa1" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Faccessmyinfo.org" target="blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Faccessmyinfo.org">
      <img ng-src="img/facebook.svg" class="w2" src="img/facebook.svg">
    </a>
    <a class="btn btn-social dib fill-white pa1" href="https://twitter.com/intent/tweet?text=Do%20you%20know%20you%20have%20the%20right%20to%20access%20your%20own%20personal%20info%3F%20Find%20out%20what%20companies%20know%20about%20you%20at%20https%3A%2F%2Faccessmyinfo.org" target="blank">
      <img ng-src="img/twitter.svg" class="w2" src="img/twitter.svg">
    </a>
    <span class="display-none-ns">
        <a class="btn btn-social dib fill-white pa1" href="whatsapp://send?text=Do%20you%20know%20you%20have%20the%20right%20to%20access%20your%20own%20personal%20info%3F%20Find%20out%20what%20companies%20know%20about%20you%20at%20https%3A%2F%2Faccessmyinfo.org">
            <img ng-src="img/whatsapp.svg" class="w2" src="img/whatsapp.svg">
        </a>
    </span>
  </div>
<hr>
<p>Encore curieux? Vous pouvez envoyer plusieurs demandes d'accès grâce à Obtenir mes infos :</p>
<button class="btn btn-primary" onclick="window.location.reload()">Créer une autre demande d'accès</button>
</section>

<!-- 
****************************************************
***  
***  END OF ALL STAGES, AND TEMPLATES
***  Below is creits and footer info
***  
****************************************************
 -->
<section id="about" class="tc mt4">
<h2 class="f6 mt4">Obtenir mes infos est maintenu par</h3>
<p><a href=""><img class="w4" src="img/logo.png" alt="Your logo"/></a></p>
<p><strong>Des questions?</strong> contactez <a href="mailto:email@yourorg.ca">email@yourorg.ca</a> pour en savoir plus.</p>

<h2 class="f4 mt4">À propos de ce projet</h2>
<p class="f6 tl">Obtenir mes infos (OMI) est un service web qui vous permet de découvrir ce que des entreprises savent à votre sujet. Ce service vous guide pas-à-pas lors de la création d'une lettre officielle de demande d'accès à vos renseignements personnels. Cette lettre peut ensuite être envoyée par la poste ou par courriel au responsable de la protection de la vie privée d'une entreprise, ou jointe à l'outil de demande d'accès aux renseignements personnels du gouvernement fédéral.</p>
</section>
</div>
<section class="bg-dark-gray">
<div class="container center pv4 mt5">
            <p class="f7 moon-gray"><strong>Politique sur la protection des renseignements personnels:</strong> Ce service ne recueille aucun des renseignements personnels que vous fournissez. Ces renseignements sont utilisés uniquement pour générer une lettre, qui est créée entièrement par votre fureteur web. D'autres pages web vers lesquelles ce service vous dirige via des hyperliens sont régies par des politiques de confidentialité différentes. Quand vous utilisez le service, le serveur web qui héberge le service enregistre l'adresse IP utilisée pour accéder à chaque ressource requise pour fournir le service, la date et l'heure de l'accès ainsi que plusieurs autres métadonnées dépersonnalisées.
            <p class="f7 moon-gray"><strong>Avertissement </strong>: Ce site est un outil de recherche et d'éducation. Il est uniquement destiné à des fins d'information. Il ne donne pas d'avis juridique. Vous êtes le seul responsable de l'usage que vous faites de ce site et des conséquences qui peuvent en résulter. {{VOTRE ORG}} ne font aucune représentation, promesse ou garantie sur le caractère exact, complet ou pertinent de l'information contenue dans ce site. Ce logiciel est offert tel quel, sans garantie. Rien sur ce site ne devrait être considéré comme un avis juridique provenant d'un professionnel.</p>
            <p class="f7 moon-gray">Ce travail est offert sous la licence Creative Commons Attribution - Pas d’Utilisation Commerciale - Partage dans les Mêmes Conditions 4.0 International..</p>
        </div>
</section>
<!-- 
****************************************************
***  
***  This is a hidden form used to submit statistics,
***  if the option is enabled, and if the user doesn't
***  opt-out.
***  
****************************************************
 -->
<form id="requestForm" class="dn">
  <label><span>Company</span><input name="ami_company" class="db" id="request_form_company"/></label>
  <!-- Set this input to the language you're using and make sure stats/private/validate_company.php is updated accordingly -->
  <label><span>Language</span> <input name="ami_lang" class="db" id="request_form_lang" value="en"/></label>
  <label><span>HMAC</span> <input name="ami_hmac" class="db" id="request_form_hmac"/></label>
  <label><span>Token</span> <input name="ami_stats_token" class="db" id="request_form_token"/></label>
  <span>Server Response: </span><span id="serverResponse" class="db ba1 bg-light-gray"></span>
</form>
  <script src="js/vendor/modernizr-3.7.1.min.js"></script>
  <script src="js/ami_app/init.js"></script>
  <script src="js/ami_app/data_utilities.js"></script>
  <script src="js/ami_app/template_engine.js"></script>
  <script src="js/ami_app/router.js"></script>
  <script src="js/ami_app/industry.js"></script>
  <script src="js/ami_app/company.js"></script>
  <script src="js/ami_app/info.js"></script>
  <script src="js/ami_app/identifiers.js"></script>
  <script src="js/ami_app/request.js"></script>
  <script src="js/ami_app/request_helpers.js"></script>
  <script src="js/ami_app/stages.js"></script>
  <script src="js/canvasDoc.js"></script>
  <script type="text/javascript">
    // Defer loading of pdfmake library to save bandwidth on initial load
    window.onload = function(){
      var pdfScriptEl = document.createElement("script");
      pdfScriptEl.setAttribute("src", "js/vendor/pdfmake-browserified.min.js");
      document.body.appendChild(pdfScriptEl);
    }
  </script>
  <script type="text/javascript">
    //  Get data for site from JSON file
    //  Update the en.json file if you create another one for a different language version of the app
    amiApp.getData("data/fr.json", function(AMIData){
      // Start App once data available
      amiApp.dataSource = AMIData;
      amiApp.initialize();
      // Enable stats functinoality. 
      // Comment out everything in this script block if you don't want to track stats.
      amiApp.stats = {
        lang: "en"
      };
      amiApp.stats.optOut = false;
      <?php
        require_once("../stats/private/get_token.php");
      ?>

      amiApp.stats.postURL = "http://localhost:8888/ami/stats/process_request.php";

      // Add shims and polyfills for IE11 crypto
      if(window.msCrypto){
        var c1 = document.createElement("script");
        var c2 = document.createElement("script");
        var c3 = document.createElement("script");
        c1.setAttribute("src", "js/vendor/promise-polyfill.min.js");
        c2.setAttribute("src", "js/vendor/webcrypto-shim.min.js");
        c3.setAttribute("src", "js/vendor/textencoder-polyfill.js");
        document.body.appendChild(c1);
        document.body.appendChild(c2);
        document.body.appendChild(c3);
      }

      var cryptoScriptEl = document.createElement("script");
      cryptoScriptEl.setAttribute("src", "js/ami_app/crypto.js");
      document.body.appendChild(cryptoScriptEl);

      var statsScriptEl = document.createElement("script");
      statsScriptEl.setAttribute("src", "js/ami_app/stats_helpers.js");
      document.body.appendChild(statsScriptEl);
    });
  </script>
</body>

</html>
