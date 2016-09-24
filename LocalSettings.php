<?php

// Protect against web entry
if (!defined('MEDIAWIKI')) {
    exit;
}

require_once __DIR__.'/dbconfig.php';

// Uncomment this to disable output compression
// $wgDisableOutputCompression = true;

$wgSitename = 'ShakePeers';

// The URL base path to the directory containing the wiki;
// defaults for all runtime URL paths are based off of this.
// For more information on customizing the URLs
// (like /w/index.php/Page_title to /wiki/Page_title) please see:
// http://www.mediawiki.org/wiki/Manual:Short_URL
$wgScriptExtension = '.php';
$wgArticlePath = "$wgScriptPath/$1";
$wgUsePathInfo = false;

// The relative URL path to the skins directory
$wgStylePath = "$wgScriptPath/skins";

// The relative URL path to the logo.  Make sure you change this from the default,
// or else you'll overwrite your logo when you upgrade!
$wgLogo = "$wgScriptPath/logo-shakepeers.png";
$wgFavicon = "$wgScriptPath/favicon.png";

// UPO means: this is also a user preference option

$wgEnableEmail = true;
$wgEnableUserEmail = true; // UPO

$wgEmergencyContact = 'contact@shakepeers.org';
$wgPasswordSender = 'contact@shakepeers.org';

$wgEnotifUserTalk = false; // UPO
$wgEnotifWatchlist = false; // UPO
$wgEmailAuthentication = true;

// MySQL specific settings
$wgDBprefix = 'mediawiki';

// MySQL table options to use during installation or update
$wgDBTableOptions = 'ENGINE=InnoDB, DEFAULT CHARSET=binary';

// Experimental charset support for MySQL 5.0.
$wgDBmysql5 = false;

// Shared memory settings
$wgMainCacheType = CACHE_NONE;
$wgMemCachedServers = [];

// InstantCommons allows wiki to use images from http://commons.wikimedia.org
$wgUseInstantCommons = true;

// To enable image uploads, make sure the 'images' directory
// is writable, then set this to true:
$wgEnableUploads = true;
$wgGenerateThumbnailOnParse = true;
$wgUseImageMagick = true;
$wgImageMagickConvertCommand = '/usr/bin/convert';
$wgFileExtensions = array_merge(
    $wgFileExtensions,
    ['pdf']
);

// If you use ImageMagick (or any other shell command) on a
// Linux server, this will need to be set to the name of an
// available UTF-8 locale
$wgShellLocale = 'fr_FR.utf8';

// If you want to use image uploads under safe mode,
// create the directories images/archive, images/thumb and
// images/temp, and make them all writable. Then uncomment
// this, if it's not already uncommented:
//$wgHashedUploadDirectory = false;

// Set $wgCacheDirectory to a writable directory on the web server
// to make your wiki go slightly faster. The directory should not
// be publically accessible from the web.
//$wgCacheDirectory = "$IP/cache";

// Site language code, should be one of the list in ./languages/Names.php
$wgLanguageCode = 'fr';

// Default skin: you can change the default skin. Use the internal symbolic
// names, ie 'standard', 'nostalgia', 'cologneblue', 'monobook', 'vector':
//$wgDefaultSkin = "vector";

// For attaching licensing metadata to pages, and displaying an
// appropriate copyright notice / icon. GNU Free Documentation
// License and Creative Commons licenses are supported so far.
$wgRightsPage = 'ShakePeers:Licence'; // Set to the title of a wiki page that describes your license/copyright
$wgRightsUrl = 'http://creativecommons.org/licenses/by-sa/3.0/';
$wgRightsText = 'ShakePeers:Licence';
$wgRightsIcon = 'https://i.creativecommons.org/l/by-sa/3.0/fr/88x31.png';

// Path to the GNU diff3 utility. Used for conflict resolution.
$wgDiff3 = '/usr/bin/diff3';

// Query string length limit for ResourceLoader. You should only set this if
// your web server has a query string length limit (then set it to that limit),
// or if you have suhosin.get.max_value_length set in php.ini (then set it to
// that value)
$wgResourceLoaderMaxQueryLength = -1;

// End of automatically generated settings.
// Add more configuration options below.

//############################ Shakepeers

//######## 0. Global settings
// We enable Lockdown
// Global user rights
$wgGroupPermissions['*']['edit'] = false;
$wgGroupPermissions['*']['read'] = true;
$wgGroupPermissions['user']['edit'] = true;
$wgGroupPermissions['user']['createpage'] = true;
$wgGroupPermissions['user']['move'] = false;
$wgGroupPermissions['editeur']['read'] = true;
$wgGroupPermissions['editeur']['edit'] = true;
$wgGroupPermissions['editeur']['createpage'] = true;
$wgGroupPermissions['editeur']['createtalk'] = true;
$wgGroupPermissions['editeur']['move'] = true;
$wgGroupPermissions['editeur']['reviewandmerge'] = true;

//Restrict main namespace
$wgNamespaceProtection[NS_MAIN] = ['edit-main'];
$wgGroupPermissions['editeur']['edit-main'] = true;

// Brouillon
define('NS_BROUILLON', 3000);
define('NS_BROUILLON_TALK', 3001);
$wgExtraNamespaces[NS_BROUILLON] = 'Brouillon';
$wgExtraNamespaces[NS_BROUILLON_TALK] = 'Brouillon_talk';
$wgContentNamespaces[] = 3000;
$wgContentNamespaces[] = 3001;
$wgNamespacesWithSubpages[NS_BROUILLON] = false;
$wgNamespacesWithSubpages[NS_BROUILLON_TALK] = false;

// Révision
define('NS_REVISION', 4000);
define('NS_REVISION_TALK', 4001);
$wgExtraNamespaces[NS_REVISION] = 'Revision';
$wgExtraNamespaces[NS_REVISION_TALK] = 'Revision_talk';
$wgContentNamespaces[] = 4000;
$wgContentNamespaces[] = 4001;
$wgNamespacesWithSubpages[NS_REVISION] = true;
$wgNamespacesWithSubpages[NS_REVISION_TALK] = true;

// Publication
define('NS_PUBLICATION', 5000);
define('NS_PUBLICATION_TALK', 5001);
$wgExtraNamespaces[NS_PUBLICATION] = 'Publication';
$wgExtraNamespaces[NS_PUBLICATION_TALK] = 'Publication_talk';
$wgContentNamespaces[] = 5000;
$wgContentNamespaces[] = 5001;
$wgNamespacesWithSubpages[NS_PUBLICATION] = true;
$wgNamespacesWithSubpages[NS_PUBLICATION_TALK] = true;

// Brouillon permissions
$wgNamespaceProtection[NS_BROUILLON] = ['b-rights'];
$wgGroupPermissions['editeur']['b-rights'] = true;
$wgGroupPermissions['*']['b-rights'] = true;
$wgNamespacePermissionLockdown[NS_BROUILLON]['read'] = ['*'];
$wgNamespacePermissionLockdown[NS_BROUILLON]['createpage'] = ['user'];
$wgNamespacePermissionLockdown[NS_BROUILLON]['edit'] = ['user'];
$wgNamespacePermissionLockdown[NS_BROUILLON]['createtalk'] = ['user'];
$wgNamespacePermissionLockdown[NS_BROUILLON]['*'] = ['editeur'];
$wgNonincludableNamespaces[] = NS_BROUILLON;

// Revision permissions
$wgNamespaceProtection[NS_REVISION] = ['r-rights'];
$wgGroupPermissions['editeur']['r-rights'] = true;
$wgGroupPermissions['user']['r-rights'] = true;
$wgGroupPermissions['*']['r-rights'] = false;
$wgNamespacePermissionLockdown[NS_REVISION]['read'] = ['*'];
$wgNamespacePermissionLockdown[NS_REVISION]['edit'] = ['sysop'];
$wgNamespacePermissionLockdown[NS_REVISION]['createpage'] = ['editeur'];
$wgNamespacePermissionLockdown[NS_REVISION]['createtalk'] = ['editeur'];
$wgNamespacePermissionLockdown[NS_REVISION]['*'] = ['sysop'];
$wgNonincludableNamespaces[] = NS_REVISION;

// Publication permissions
$wgNamespaceProtection[NS_PUBLICATION] = ['pub-rights'];
$wgGroupPermissions['editeur']['pub-rights'] = true;
$wgGroupPermissions['user']['pub-rights'] = false;
$wgNamespacePermissionLockdown[NS_PUBLICATION]['read'] = ['*'];
$wgNonincludableNamespaces[] = NS_PUBLICATION;

// Pour cacher certains titres de page
$wgRestrictDisplayTitle = false;

// Set Default Timezone
$wgLocaltimezone = 'Europe/Paris';
$oldtz = getenv('TZ');
putenv("TZ=$wgLocaltimezone");

wfLoadSkin('Vector');
//error_reporting( -1 );
//ini_set( 'display_errors', 1 );

//######## I. Plugin require zone
// Wiki Editor
require_once "$IP/extensions/WikiEditor/WikiEditor.php";
// Enables use of WikiEditor by default but still allow users to disable it in preferences
$wgDefaultUserOptions['usebetatoolbar'] = 1;
$wgDefaultUserOptions['usebetatoolbar-cgd'] = 1;
// Displays the Preview and Changes tabs
$wgDefaultUserOptions['wikieditor-preview'] = 1;
// Displays the Publish and Cancel buttons on the top right side
$wgDefaultUserOptions['wikieditor-publish'] = 1;

// Liquid Threads
require_once "$IP/extensions/LiquidThreads/LiquidThreads.php";

// CategoryTree
$wgUseAjax = true;
require_once "$IP/extensions/CategoryTree/CategoryTree.php";

// Cite
require_once "$IP/extensions/Cite/Cite.php";
//require_once("$IP/extensions/Cite/SpecialCite.php");

// Maintenance shell
require_once "$IP/extensions/MaintenanceShell/MaintenanceShell.php";

// Nuke
require_once "$IP/extensions/Nuke/Nuke.php";

// Rename user
require_once "$IP/extensions/Renameuser/Renameuser.php";

// Wiki Article Feeds
//require_once "$IP/extensions/WikiArticleFeeds/WikiArticleFeeds.php";

// Dynamic Page List
require_once "$IP/extensions/Intersection/DynamicPageList.php";

// Input box
require_once "$IP/extensions/InputBox/InputBox.php";

// Labeled Section Transclusion
require_once 'extensions/LabeledSectionTransclusion/lst.php';

// Parser functions
require_once "$IP/extensions/ParserFunctions/ParserFunctions.php";

// Preloader
require_once "{$IP}/extensions/Preloader/Preloader.php";
$wgPreloaderSource[NS_TEMPLATE] = 'Modèle:LoaderModèle';

// Etherpad Lite
require_once "$IP/extensions/EtherpadLite/EtherpadLite.php";
$wgEtherpadLiteDefaultPadUrl = 'http://beta.etherpad.org/p/';
$wgEtherpadLiteUrlWhitelist = [
    'http://beta.etherpad.org/p/',
    'http://lite.framapad.org/p/',
    'http://lite4.framapad.org/p/',
];
$wgEtherpadLiteDefaultWidth = '760px';
$wgEtherpadLiteDefaultHeigth = '600px';

// RSS
require_once "$IP/extensions/RSS/RSS.php";
require_once "$IP/extensions/WikiArticleFeeds/WikiArticleFeeds.php";
$wgRSSUrlWhitelist = ['*'];

// Bootstrap
//require_once("$IP/extensions/Bootstrap/Bootstrap.php");

//Lockdown
require_once "$IP/extensions/Lockdown/Lockdown.php";

// Shakepeers Skin
require_once "$IP/skins/shakepeers/shakepeers.php";
$wgDefaultSkin = 'shakepeers';

//require_once("$IP/skins/chameleon/Chameleon.php");
//$wgDefaultSkin = 'chameleon';

//require_once("$IP/extensions/Annotator/Annotator.php");

// HideNamespace extension
require_once "$IP/extensions/HideNamespace/HideNamespace.php";
$wgHidensNamespaces = [NS_BROUILLON, NS_REVISION, NS_PUBLICATION, NS_MAIN];

//require_once("$IP/extensions/Echo/Echo.php");
require_once "$IP/extensions/EventLogging/EventLogging.php";
require_once "$IP/extensions/GuidedTour/GuidedTour.php";


 $wgShowExceptionDetails = true;

 require_once __DIR__.'/extensions/Duplicator/Duplicator.php';
 //require_once( "$IP/extensions/Reviews/Reviews.php" );

 $wgShowSQLErrors = 1;

  $wgGroupPermissions['*']['createaccount'] = true;

  require_once "$IP/extensions/HeaderFooter/HeaderFooter.php";

  require_once "$IP/extensions/UserMerge/UserMerge.php";
// By default nobody can use this function, enable for bureaucrat?
$wgGroupPermissions['sysop']['usermerge'] = true;

//ConfirmEdit
require_once "$IP/extensions/ConfirmEdit/ConfirmEdit.php";
//require_once( "$IP/extensions/ConfirmEdit/QuestyCaptcha.php");
//$wgCaptchaClass = 'QuestyCaptcha';
//$wgCaptchaQuestions[] = array(
//'question'=>'Quelle est la couleur du logo de ShakePeers ?<br/>(Deux réponses possibles)',
//'answer'=>array('orange', 'bleu'));
wfLoadExtension('ConfirmEdit/ReCaptchaNoCaptcha');
$wgCaptchaClass = 'ReCaptchaNoCaptcha';
$wgGroupPermissions['emailconfirmed']['skipcaptcha'] = true;
$ceAllowConfirmedEmail = true;

// PageCreator
require_once "$IP/extensions/PageCreator/PageCreator.php";

// PageContributors
require_once "$IP/extensions/PageContributors/PageContributors.php";

//Review and Merge
//$ReviewAndMergeNamespace = NS_REVISION;
//require_once 'extensions/ReviewAndMerge/ReviewAndMerge.php';

//Commons
$wgUseInstantCommons = false;
//À la main pour forcer HTTPS
$wgForeignFileRepos[] = [
   'class'                   => 'ForeignAPIRepo',
   'name'                    => 'wikimediacommons',
   'apibase'                 => 'https://commons.wikimedia.org/w/api.php',
   'hashLevels'              => 2,
   'fetchDescription'        => true,
   'descriptionCacheExpiry'  => 43200,
   'apiThumbCacheExpiry'     => 86400,
];
//HTTPS pour la connexion
$wgSecureLogin = true;

//Handling metadata through Variables plugin
require_once "$IP/extensions/Variables/Variables.php";

// testing bootstrap skin
require_once "$IP/skins/bootstrap/bootstrap-mediawiki.php";

//Retrait du logo BootStrap qui ne passe pas en HTTPS
$wgFooterIcons['poweredby']['bootstrapskin'] = null;

//Façon rapide d'jaouter des meta, on fera mieux plus tard
$wgExtensionFunctions[] = 'globalMeta';
function globalMeta()
{
    global $wgOut;
    $wgOut->addLink(['href' => 'https://plus.google.com/108003235251976174724', 'rel' => 'publisher']);
    $wgOut->addMeta('google-site-verification', 'URwGTfsT8pujcNULONNPO0KtDVju3zrmA66wMEsqkP0');
    $wgOut->addMeta('og:image', 'https://shakepeers.org/logo_shakepeers.jpg');
    $wgOut->addHeadItem('orgLogo', '<script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "NGO",
      "url": "https://shakepeers.org/",
      "logo": "https://shakepeers.org/logo_shakepeers.jpg",
      "sameAs" : ["https://www.facebook.com/ShakePeers", "https://twitter.com/ShakePeers",
		"https://plus.google.com/108003235251976174724"]
    }
    </script>');
}


//SVG
$wgFileExtensions[] = 'svg';
$wgAllowTitlesInSVG = true;

// Stats purpose (pour {{PAGEINNAMESPACE}} http://www.mediawiki.org/wiki/Help:Magic_words/fr)
$wgAllowSlowParserFunctions = true;

//Math
require_once "$IP/extensions/Math/Math.php";

//Twitter cards
require_once "$IP/extensions/TextExtracts/TextExtracts.php";
require_once "$IP/extensions/TwitterCards/TwitterCards.php";

//OpenGraph
require_once "$IP/extensions/Description2/Description2.php";
require_once "$IP/extensions/OpenGraphMeta/OpenGraphMeta.php";

//Fork
// Change authors
//require_once("$IP/extensions/ChangeAuthor/ChangeAuthor.php");
//$wgGroupPermissions['editeur']['changeauthor'] = true; // Only editeur can use ChangeAuthor


//PayPal
include 'extensions/Paypal/Paypal.php';


//CheckUser
require_once "$IP/extensions/CheckUser/CheckUser.php";
$wgGroupPermissions['sysop']['checkuser'] = true;
$wgGroupPermissions['sysop']['checkuser-log'] = true;


//SitelinksSearchBox
require_once "$IP/extensions/SitelinksSearchBox/SitelinksSearchBox.php";

//BreadcrumbList
require_once "$IP/extensions/BreadcrumbList/BreadcrumbList.php";

//Affichage des PDF
require_once "$IP/extensions/PdfHandler/PdfHandler.php";

//Éditeur visuel
require_once "$IP/extensions/VisualEditor/VisualEditor.php";
// Enable by default for everybody
$wgDefaultUserOptions['visualeditor-enable'] = 1;
// Don't allow users to disable it
$wgHiddenPrefs[] = 'visualeditor-enable';
// OPTIONAL: Enable VisualEditor's experimental code features
//$wgDefaultUserOptions['visualeditor-enable-experimental'] = 1;
$wgVisualEditorParsoidURL = 'http://localhost:8142';
$wgVisualEditorParsoidPrefix = 'localhost';
$wgVisualEditorSupportedSkins = ['vector', 'chameleon', 'shakepeers'];

//BetaFeatures
require_once "$IP/extensions/BetaFeatures/BetaFeatures.php";

//TemplateData
wfLoadExtension('TemplateData');

//Piwik
require_once "$IP/extensions/PiwikIntegration/Piwik.php";
$wgPiwikURL = "piwik.animafac.net/";
$wgPiwikIDSite = "4";
