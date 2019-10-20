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
  <title>Access My Info</title>
  <meta name="description" content="Organizations are required by Canadian privacy laws to disclose your personal information to you upon request. We can help with that.">
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

<div class="dn-l db pa2 f6 tc black" style="background:#81EED3"><?php include('../stats/get_count.php');?> requests and counting!</div>
<header class="navbar bg-blue clearfix relative pv3">
  <div class="container center tc">
    <h1 class="ph1 mb0 mt1"><span>
        <!-- ADD YOUR LOGO HERE -->
        <img class="w10 width-titleimage-ns mw-100 w5-ns w4 mb1" alt="Access My Info Logo" src="img/logo.png">
    </span></h1>
    <div>
  </div>
  <div class="absolute top-1 right-1 tr mw5">
    <a class="dib btn btn-primary f7" href="index-fr.php">Français</a><br>
    <div class="dn dib-l pa2 f6 br2 mt2 mw5 black" style="background:#81EED3"><?php include('../stats/get_count.php');?> requests and counting!</div>
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
          <span class="dn di-ns">Start</span>
        </a>
      </li>
      <li class="flex items-stretch">
        <a id="nav_el_company" class="pv2 ph4 active flex items-center justify-center">
          <span class="db dn-ns">2</span>
          <span class="dn di-ns">Select a Company</span>
        </a>
      </li>
      <li class="flex items-stretch">
        <a id="nav_el_information" class="pv2 ph4 active flex items-center justify-center">
          <span class="db dn-ns">3</span>
          <span class="dn di-ns">Select Data</span>
        </a>
      </li>
      <li class="flex items-stretch">
        <a id="nav_el_identifiers" class="pv2 ph4 active flex items-center justify-center">
          <span class="db dn-ns">4</span>
          <span class="dn di-ns">Add ID Info</span>
        </a>
      </li>
      <li class="flex items-stretch">
        <a id="nav_el_request" class="pv2 ph4 active flex items-center justify-center">
          <span class="db dn-ns">5</span>
          <span class="dn di-ns">Generate Request</span>
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
    <h2 class="tc">Welcome to Access My Info!</h2>
  <p class="lh-copy">What do companies know about you? What do they keep on file? Who do they share it with? Organizations are required by Canadian privacy laws to disclose this information to their customers upon request. We can help with that.</p>
  <!-- This paragraph must be deleted if stats aren't enabled. It shows how many requests have been generated. -->
  <p class="f4 tc">Canadians have generated <strong><?php require_once('../stats/get_count.php');?></strong> requests using this tool.</p>
    <div class="bg-light-gray pa3 mt4">
        <p class="f6 b tc">Click an option below to start your request:</p>
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
      <p class="tc f6">You may make multiple requests with our website (but one at a time!).</p>
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
    <h2 class="tc ph2 ph0-ns">Select your service provider</h2>
    <p class="lh-copy ph2 ph0-ns"><strong>Begin your request</strong> by selecting a company that provides you a service.</p>
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
        <p><a id="custom_toggle" class="dark-red pointer"><strong>Help:</strong>My company isn't listed</a></p>
        <!----><form class="dn" id="custom_form">
         <div class="bg-light-gray pa3 mt2">
          <h3 class="mt0">Add custom company</h3>
          <label class="form-item">
            Company Name<input type="text" name="custom_name">
          </label>
          <fieldset>
          <legend translate="customCompany.contactOverview">Company Privacy Contact</legend>
          <p>Please provide the contact information for the person responsible for interacting with the public regarding customer privacy. Usually this information can be found on the company's privacy policy.</p>
          <p><strong>Provide either a full mailing address or an email address.</strong></p>
          <label class="form-item">
            Title:<input type="text" name="custom_title"></label>
          <label class="form-item">
            Email address:<input type="text" name="custom_email"></label>
          <label class="form-item">
            Address 1<input type="text" name="custom_address_1"></label>
          <label class="form-item">
            Address 2<input type="text" name="custom_address_2"></label>
          <label class="form-item">
            City<input type="text" name="custom_city"></label>
          <label class="form-item">
            Province / State<input type="text" name="custom_province"></label>
          <label class="form-item">
            Postal / Zip Code <input type="text" name="custom_postal_code"></label>
          <label class="form-item">
            Country<input type="text" name="custom_country"></label>
          </fieldset>
          </div>
        </form>
      </div>
      <div class="cf mt2">
        <button class="btn btn-previous fl" id="back_el_company">Back</button>
        <button class="btn fr" id="next_el_company">Next</button>
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
    <h2 class="tc ph2 ph0-ns">What data do you want to access?</h2>
    <p class="lh-copy ph2 ph0-ns">Make inquiries about how your data is collected, used, shared and stored.</p>
    <div class="bg-light-gray pv3 ph4">
      <!-- Selected company name template and value container -->
      <h3>Data requested from <span id="information_company_name"><span ami_template_id="info_company_template"><span ami_template_value_container="name">Org</span></span></span></h3>
      <span class="note f4">This list is meant to be exhaustive. 
        <strong>
          <!-- The below span id is a hack, and the content gets replaced with JS... I got lazy and didn't register a full template for it. -->
          <span id="information_company_name2">Org</span> 
        may not retain some of these items</strong>.</span>
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
        <button class="btn btn-previous fl" id="back_el_information">Back</button>
        <div class="fr" id="info_category_select_button">
          <button class="btn" ami_template_id="info_category_select_button_template">
            <span>Next</span>
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
    <h2 class="tc ph2 ph0-ns">Identifying information</h2>
    <p class="lh-copy ph2 ph0-ns">Enter your information so <span id="identifiers_company_name">
      <!-- Company name here -->
      <span ami_template_id="identifiers_company_template">
        <span ami_template_value_container="name">Org</span>
      </span>
    </span> can identify you in their records.</p>
    <p class="lh-copy ph2 ph0-ns b">Access My Info will not collect or store any of the personal information below.</p>
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
        <p>I consent and authorize:</p>
        <div class="ml2 mt3 mb4">
        <label><input type="checkbox" id="optout" class="mr1"/>{{YOUR ORG}} may collect basic information about from whom I requested data for statistical purposes.</label>
        </div>
      </div>
      <div class="cf">
        <button class="btn btn-previous fl" id="back_el_identifiers">Back</button>
        <div class="fr" id="personal_identifiers_button">
          <button class="btn" ami_template_id="personal_identifiers_button_template">
            <span>Generate Request</span>
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
    <h2 class="tc ph2 ph0-ns">Your request is ready</h2>
    <p class="lh-copy ph2 ph0-ns">Your letter to <span id="request_company_name">
      <!-- Company name -->
      <span ami_template_id="request_company_template"><span ami_template_value_container="name">Org</span>
    </span></span> has been successfully generated by our system. Now, it's up to you to send it!</p>
    <p class="lh-copy ph2 ph0-ns b">Read over the letter carefully, then follow the instructions below.</p>

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
<h2 class="tc ph2 ph0-ns" id="method_title_both">How would you like to send your letter?</h2>
<h2 class="tc ph2 ph0-ns" id="method_title_mail_only">This company currently only accepts requests by postal mail.</h2>
<div id="mail_method">
  <h3>Postal Mail</h3>
  <div class="bg-light-gray pa4 f5">
    <p>Use the button below to create a PDF of your letter. Then print it and mail it to:</p>
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
        <span>Create PDF Letter</span>
      </button>
    </div>
  </div>
</div>
<h2 class="tc ph2 ph0-ns" id="method_title_email_only">This company currently only accepts requests by email.</h2>
<div id="email_method">
  <h3>Email</h3>
  <div class="bg-light-gray pa4 f5">
      <div>
        <!-- Don't mess with the IDS, but this is used for email send option. Feel free to adjust classes, as usual -->
      <h3>Follow these five easy steps to send your email:</h3>
      <ol id="email_instructions">
      <li class="flex w-100 pb4 mb2">
        <div class="pl3 w-70">
          Copy your request letter to your system clipboard.
        </div>
        <div class="w-30 tr">
          <button id="request_copy_button" class="btn btn-primary f6">click to copy</button>
        </div>
      </li>
      <li class="flex w-100  pv4 mv2 bt b-black">
        <div class="pl3 w-40">
          Open your email client.
        </div>
        <div class="w-60 tr">
          <div class="dib mb3" id="request_email_button">
          <a class="btn btn-primary f6" ami_template_id="request_email_button_template">
            <span>Open default email</span>
          </a>
        </div>
          <div class="dib" id="request_gmail_button">
          <a class="btn btn-primary f6" ami_template_id="request_gmail_button_template" target="blank">
            <span>Open Gmail</span>
          </a>
        </div>
      </div>
    </li>
      <li class="flex w-100 pv4 mv2 bt b-black">
        <div class="pl3 w-50">Review the <em>to</em> and <em>subject</em> fields.</div>
        <div class="w-50 f6 bg-white ml2 pa2">
        <strong>To: </strong>    <span id="request_email_address">
      <!-- Print out email address of the org -->
      <address class="di" ami_template_id="request_company_email_template">
          <span ami_template_value_container="email">
            Privacy Officer</span>
      </address>
      </span>
      <span class="db mt2">
        <strong>Subject: </strong>Formal request for Access to my personal information
      </span>
      </div>
      </li>
      <li class="pv4 mv2 bt b-black"><div class="pl3">Paste the letter into where the email content should go.</div></li>
      <li class="pt4 mt2 pb2 bt b-black"><div class="pl3">Send your message!</div></li>
    </ol>
  </div>
</div>
<div class="cf">
  <button class="btn btn-previous fl mt2" id="back_el_request">Back</button>
</div>

<p class="b lh-copy">That's it! Thank you for participating in the Access My Info project.</p>
<p class="">Spread the word about our project:</p>

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
<button class="btn btn-primary" onclick="window.location.reload()">Make another request</button>
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
<h2 class="f6 mt4">This version of Access my Info is supported by</h3>
<p><a href=""><img class="w4" src="img/logo.png" alt="Logo"/></a></p>
<p><strong>Questions?</strong> contact <a href="mailto:email@yourorg.ca">email@yourorg.ca</a> to learn more.</p>

<h2 class="f4 mt4">About this project</h2>
<p class="f6 tl">Access My Info (AMI) is a web application that enables you to find out what a variety of different companies know about you. It guides you via a step-by-step wizard to generate a formal letter that requests access to your personal information. This letter can then be sent via postal mail or email to the respective company’s privacy officer.</p>
</section>
</div>
<section class="bg-dark-gray">
<div class="container center pv4 mt5">
            <p class="f7 moon-gray"><strong>Privacy Policy:</strong> This service does not collect any of the personal information you provide. Your information is used only to generate a letter, which is done entirely in your web browser. When your web browser communicates with this service, the web server that hosts the service logs a record of that event. These logs include the IP address used to access each resource required for the service, the date &amp; time of access, and several other non-identifying metadata fields. Other web pages linked to from this service will be governed by different policies.
            <p class="f7 moon-gray"><strong>Disclaimer</strong>: This is a research and educational tool and is meant for informational purposes only. This service does not provide legal advice. You are solely responsible for your use of this service and any resulting consequences. {{YOUR ORG}} make no claims, promises, or guarantees about the accuracy, completeness, or adequacy of the information contained in this document. This software is offered as-is, with no warranty. Nothing herein should be used as a substitute for the legal advice of competent counsel.</p>
            <p class="f7 moon-gray">This work is based on Access My Info by the Citizen Lab and Open Effect and licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License.</p>
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
    amiApp.getData("data/en.json", function(AMIData){
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
