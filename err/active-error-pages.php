<?php // ۞// text { encoding:utf-8 ; bom:no ; linebreaks:unix ; tabs:4sp ; }
										$active_errors['version'] = '2.1';
/*
	Active Error Pages

		The corz.org intelligent php error handler

		See here:

			http://corz.org/serv/tools/active-errors/

		;o) Cor

		(c) corz.org 2004->today
*/



/*
	Active Error Pages Settings..
											*/


// your name, as your visitors see it..
$active_errors['webmaster'] = 'the webmaster';


/*
	Email Address

	Uses the email-masher (at the foot of this script).

	The email address to mash goes here..

																*/
$active_errors['email_address'] = mail_mash('errors@mydomain.com');

// or you can just comment out the two lines above and use simply..
// $active_errors['email_address'] = 'i-like-spam@crazypeople.net'; // un-comment if you like spam


/*
	Location of your css file,
	as used by an @import command..
													*/
$active_errors['css_location'] = '/err/err.css';


/*
	IGNORE folders, for the scanning..

	One '/inc/' covers all '/inc/' folders onsite.
	You can also be more specific, as in '/inc/tools/'

	NOTE: Commas *between* entries..
										*/
$active_errors['ignore_folders'] = array(
	'/secret/',
	'/private/',
	'/includes/',
	'/err/',
	'/inc',
	'/demo/',
	'/cgi-bin/'
	);


// files we are allowed to return results for
// note commas *between* entries..
$active_errors['allowed_extensions'] = array(
	'.htm',
	'.html',
	'.shtml',
	'.txt',
	'.doc',
	'.php',
	'.php3',
	'.phps',
	'.jpg',
	'.jpeg',
	'.png',
	'.gif',
	'.nfo',
	'.au3',
	'.zip',
	'.pdf'
	);


/*
	Search Path..										 [default: array('../')]

	By default, this script lives in /err so we start searching
	from the folder *above*, '../' i.e. the root of the site.

	If you keep this anywhere *but* in a subfolder of your root,
	please specify the FULL path to the root of your website
	something like..

		$active_errors['scan_path'] = '/var/www/html/';
	or..
		$active_errors['scan_path'] = '/Volumes/mac/webserv/cor/';

	or whatever..
									*/
$active_errors['scan_path'] = '../';


/*
	Exact Match..												 [default:false]

	default: $active_errors['exact_match'] = false;

	If a user was looking for "install.txt" and that doesn't exist in the
	location they specified, we will look for "install.txt" everywhere onsite.
	If that filename is found we will return links for files matching
	"install.txt". This is an exact match.

	If this switch is set to false (the default), we will also return hits for
	install.htm, install.php, install.jpg, etc. I prefer this, shows we are
	working extra hard for our visitors. Consider the term "web host".
									*/
$active_errors['exact_match'] = false;


/*
	Partial Match..												 [default: true]

	Searching for "install.txt", will also return
	installation.txt, installer.jpg, and so on.
										*/
$active_errors['partial_match'] = true;


/*
	Fuzzy Match..												 [default: true]

	If they typed "g-dip" in the address bar, this would return a document
	entitled "g_dip" (note underscore), as well as other *almost* matches. Quite
	neat, catches some typos, 'hit' would match 'hot', for example.
*/
$active_errors['fuzzy_match'] = true;

/*
	Fuzziness														[default: 1]

	1 is usually fuzzy enough, but 2 is also useful, depending on your file
	names. 3 is probably too much. The default is 1.
										*/
$active_errors['fuzziness_level'] = 1;


/*
	Match Directories (aka. "folders")							 [default: true]

	If the term appears in a directory name, shall we return that, too?
									*/
$active_errors['match_dirs'] = true;



/*

	Show a corzoogle search form?								 [default: true]

	default: $active_errors['corzoogle_always'] = true;

	If our scan didn't match any documents, a corzoogle form will be presented,
	thus enabling the user to perform a full content search of our website.

	If you like (and it is cool) you can have a corzoogle search form appear
	anyway, even if we did get a few matching documents. The scanning code
	for Active Error Pages is ripped out of corzoogle, anyway.

	Note:	if 'cz_location' (below) is empty, the corzoogle form won't show,
			so you could leave this set to true, and use 'cz_location' as the
			corzoogle main switch, or visa-versa.
												*/
$active_errors['corzoogle_always'] = true;



/*
	corzoogle location								 [default: '/corzoogle.php']

// leave this empty if corzoogle isn't installed on your site.
									*/
$active_errors['cz_location'] = '';	//$active_errors['cz_location'] = '/corzoogle.php';



/*
	corzoogle image location				  [default: '/err/corzoogle_sm.png']

	Location of corzoogle image, used when presenting a search for for extremely
	lost visitors.
									*/
$active_errors['cz_img_location'] = '/err/corzoogle_sm.png';




/*
	"Catchers"											  [default: 'moved.ini']

	Moved pages we catch and redirect on-the-fly.

	A simple ini file is used to store your moved pages, no need to hack rewrite
	rules with .htaccess. Set these inside "moved.ini"..

		some string = "full/path/to/resource"

	basically..

		old/page="/new/page.php"

	If the first item is contained *anywhere* within the URL, the redirection
	will occur immediately. The user usually won't realize they got a 404,
	unless they look at their address bar.

	You don't have to worry about some real site script that uses one of your
	first redirect terms, say "index.php?q=" in its URL's, being redirected by
	Active Error Pages, remember; if the user hits a valid url, they won't even
	*get* a here, there is no 404!
									(.. adapted from a recent communication ;o)

	Because it's a "catch-all", you can put generic terms in and catch any old
	thing, send it to some relevant page. If it dosn't exist, Wham! it does now!

	NOTE: BE VERY VERY CAREFUL when you edit these values, and TEST on your own
	server before uploading to your live site. Reason? Once you set a permanently
	moved redirection, it can be a bugger to shift, at least on your own system
	(see (and use) the 'redirect_testing' setting, below).

	NOTE: if you move "moved.ini" to some place/file name other than this
	file name, sitting right next to THIS script, change this to match the FULL
	path of the ini file, from your server root, e.g..

		/var/www/vhosts/mysite/htdocs/inc/ini/301s.ini

										*/
$active_errors['catchers'] = 'moved.ini';

/*
	Catchers TESTING MODE..										 [default: true]

	!!! IMPORTANT !!!		TEST TEST TEST!		!!! IMPORTANT !!!

	Especially if you are adding new catchers on a live site..

	If you are testing new redirects (in "moved.ini"), set the following setting
	to true. In this state, Active Error Pages will use a temporary redirect
	(302).

	When you are *sure* everything works as expected, set this to false to start
	sending 301 Permanent redirect headers. Job done.
										*/
$active_errors['redirect_testing'] = true;



/*
	Catchers Redirection Domain					[default: $_SERVER['HTTP_HOST']]

	Defaults to THIS domain ($_SERVER['HTTP_HOST']), but you could redirect your
	catchers to another site, too, if you like..

	$active_errors['domain'] = 'otherplace.com';

	NOTE: This sets the *default* domain, so you can usually make short links in
	the ini file, like so:

		blog/="/blog/"

	but you can also use FULL URLs inside the ini to send redirects to a
	different domain, e.g..

		blog/="http://otherdomain.com/blog/"

	In other words, you can have both. It's usually best to leave this set to
	your site's domain, using short URI's and add external redircts mindfully,
	with full URLs.
												*/
$active_errors['domain'] = $_SERVER['HTTP_HOST'];



/*
	Jump on Single Hit

	default: $active_errors['jump_on_single_hit'] = false;

	Should Active Error Pages auto-redirect on a 404 if there's only one single
	match?

	If the file system scan returns just one document, Active Error Pages can
	jump directly to it, in an "I feel lucky" style.

	Visitors go- "WTF! .. CoOL!" probably.

	You'll likely want to enable $active_errors['exact_match'] if you use this,
	though I often don't!

	This feature can use real HTTP headers or meta-refresh, your call
	(see 'jump_method' below).
											*/
$active_errors['jump_on_single_hit'] = false;	// true/false


/*
	Time to Jump

	How many seconds until hyperspace jump?

	Note: you can set this with *extreme* accuracy, e.g.. 2.131572

	If you select $active_errors['jump_method'] = 'meta'; (below) the number
	will be rounded to the nearest whole integer.
										*/
$active_errors['time_to_jump'] = 1.25;	// a value greater than 1 ensures we play nice with Anti-Hammer!
										// If you don't use Anti-Hammer, you could set this lower, even 0


/*
	Jump Method

	This only comes into effect if you have set $active_errors['jump_on_single_hit'] (above)
	to true, and the site search returns a single document.

	How to jump the browser to the new page? choices are '301', or 'meta'

	'301' won't even show the page; just like the catchers, above, it will send
	the browser a proper 301 header, redirect immediately to the new page. It's
	probable that, unless they watch the address bar, they won't even realize
	they got a 404.

	'302' acts the same way as 301 (above) but sends a "Temporary Redirect"

	'meta' will show the page for however long you set in $active_errors['time_to_jump'], and THEN
	jump the user to the new page, using a meta "refresh" header.

	BEWARE: a 301 is a fairly permanent redirect (at least for the life of the
	browser session) so use this with caution, especially if you have enabled
	fuzzy matching. However, I do exactly this at corz.org, and it's a lot of
	fun. Let's face it, they got a 404 anyway, so jumping to a new page, *any*
	page, is better than nothing. The fuzzy matching is pretty good, and more
	often than not, it jumps correctly to renamed and mis-typed documents.

	Remember, it only auto-jumps if the site search returned a SINGLE hit, so
	it's very likely that they will end up exactly where they wanted to be.

	Bottom line: Be Gung-Ho! The advantages weigh more!

	NOTE:	This setting does NOT affect your catchers redirections, which are
			/always/ sent with a 301 header (302 in testing mode).

										*/
//$active_errors['jump_method'] = 'meta'; // 301 is better
$active_errors['jump_method'] = '302'; // temporary! until you set your prefs!


// BE CAREFUL using jump_on_single_hit with a 301 permenent redirect!



/*
	visual stuff..	*/


/*
	Show Full Links?

	default: $active_errors['links_are_full'] = true;

	A display thing. If a match is found, its link and pop-up title can be shown
	as..

		somefile.php

	or as..

		http://mysite.com/some/path/to/somefile.php

	which is the "full" version. Either way, they still get the same link,
	and that full link, as always, will be displayed in their status bar.
	Like I said, it's just for looks.
										*/
$active_errors['links_are_full'] = true;



/*
	Automatically generated *other* error pages..

	Because the generation of error pages is automatic, dependant on their
	"REDITECT_STATUS", you can add as many types as are valid and desirable.

	So long as you follow the naming conventions..

		$active_errors['message_xxx']
		$active_errors['message_xxx_title']
		$active_errors['message_xxx_sub']

	.. they will be automatically generated.

	Don't forget to add the corresponding line to your .htaccess file.

*/


// 404 Messages..
$active_errors['message_404']				= 'Maybe you typed the address wrong. What do you think?';

$active_errors['message_404_title']		= '
<title>another beautifully caught "page not found" by the Active Error Pages, the intelligent error handler v'.$active_errors['version'].'..</title>
<meta name="description" content="'.$active_errors['domain'].' 404 page.. intelligent 404 handling with seek-and-return. The non-existent file file" />
<meta name="keywords" content="404,php,404 error,error handler,auto-scan,auto-find,source code available at corz.org" />';

$active_errors['message_404_sub']			= '
			If you\'re certain that a page <em>should</em>&nbsp;&nbsp;be here, please <a href="'.
			$active_errors['email_address'].'?subject=404%20-%20'.rawurlencode($_SERVER['REQUEST_URI']).
			'" title="your valuable feedback is appreciated. thanks">tell '.$active_errors['webmaster'].
			'</a> about it. Alternatively, click <a href="/" title="up to the site root">here</a> for some real links.';

// extra messages for 404 errors..
$active_errors['message_found_matches']		= 'The following documents appear to be similar to your request..';
$active_errors['message_found_NO_matches']	= 'I looked, but could not find any matching documents, sorree.';
$active_errors['message_do_a_search']		= 'You might want to corzoogle for it..';





// Other Page's Messages..

// 400..
$active_errors['message_400']			= 'Bad Request!';
$active_errors['message_400_title']		= '<title>400.. The my browser don\'t know how to send for a page page..</title>
<meta name="description" content="400 bad request error for '.$active_errors['domain'].'" />
<meta name="keywords" content="400,error,400 error,bad request error" />';
$active_errors['message_400_sub']		= '
			What was your browser <em>thinking</em>?<br />
			<br />

			You might want to  <a href="'.$active_errors['email_address'].'?subject=400%20-%20'.rawurlencode($_SERVER['REQUEST_URI']).
			'" title="your valuable feedback is appreciated. thanks">tell '.$active_errors['webmaster'].'</a> about this. Alternatively, click
			<a href="/" title="up to the site root">here</a> for a <em>basic</em> link your browser might be able to follow!';


// 401..
$active_errors['message_401']			= 'luser!';
$active_errors['message_401_title']		= '<title>401.. The ooh it looks nice in that folder file</title>
<meta name="description" content="401 bad authorisation error for '.$active_errors['domain'].'" />
<meta name="keywords" content="401,error,401 error,bad authentication error" />';
$active_errors['message_401_sub']		= '
			Maybe you forgot your password or something?<br />
			<br />

			If you\'re fairly certain you <em>should</em>&nbsp;
			be allowed in here, please <a href="'.$active_errors['email_address'].'?subject=401%20-%20'.rawurlencode($_SERVER['REQUEST_URI']).
			'" title="your valuable feedback is appreciated. thanks">tell '.$active_errors['webmaster'].'</a> about it.
			Alternatively, click <a href="/" title="up to the site root">here</a> in the public area!';



// 403..
$active_errors['message_403']			= 'Stop nosing about!';
$active_errors['message_403_title']		= '<title>403.. The you are a curious sort file</title>
<meta name="description" content="403 permission denied error for '.$active_errors['domain'].'.." />
<meta name="keywords" content="403,error,403 error,permission denied error" />';
$active_errors['message_403_sub']		= '
			if you\'re fairly certain you <em>should</em>&nbsp; be allowed in here, please
			<a href="'.$active_errors['email_address'].'?subject=403%20-%20'.rawurlencode($_SERVER['REQUEST_URI']).
			'" title="your valuable feedback is appreciated. thanks">tell '.$active_errors['webmaster'].'</a> about it.
			alternatively, click <a href="/" title="up to the site root">here</a> in the approved area!';



// 410..
$active_errors['message_410']			= 'It is Gone!';
$active_errors['message_410_title']		= '<title>410.. The that page is really gone page..</title>
<meta name="description" content="410 page gone error for '.$active_errors['domain'].'" />
<meta name="keywords" content="410,error,410 error,page gone error,document gone error" />';
$active_errors['message_410_sub']		= '
			Really, it\'s not here! It\'s an ex-page. Gone! Vanished! Absconded! Departed! It hit the road, Jack! Made a break for it!
			Pushed off, quit, run away, set off, skipped out, split, took flight! Vamoose!<br />
			<br />

			You might want to  <a href="'.$active_errors['email_address'].'?subject=410%20-%20'.rawurlencode($_SERVER['REQUEST_URI']).'"
			title="your valuable feedback is appreciated. thanks">tell '.$active_errors['webmaster'].'</a> about this.
			Alternatively, click <a href="/" title="up to the site root">here</a> for page that is definitely <em>not</em> gone!';


// 500..
$active_errors['message_500']			= 'Oh Shite!';
$active_errors['message_500_title']		= '<title>500.. The I fu*ked up big-style file</title>
<meta name="description" content="500 server error for '.$active_errors['domain'].'" />
<meta name="keywords" content="500,error,500 error, 500 server error" />';
$active_errors['message_500-sub']		= '
			This does not look good. More than likely '.$active_errors['webmaster'].' is messing around
			with the <a href="http://corz.org/serv/tricks/htaccess.php" title="Apache control" id="link_htaccess-tips"
			onclick="window.open(this.href); return false;"><code>.htaccess</code></a> files again, or something. Give it a moment or two and refresh,
			if you aren\'t in too much of a hurry.<br />
			<br />

			If this lasts, '.$active_errors['webmaster'].' would <strong>definitely</strong> like to <a href="'.
			$active_errors['email_address'].'?subject=500%20-%20'.rawurlencode($_SERVER['REQUEST_URI']).
			'" title="your valuable feedback is appreciated. thanks">hear about it</a>. Alternatively, click <a href="/"
			title="up to the site root">here</a> in the site root, which might still work, okay.';

// 503..
$active_errors['message_503']			= 'Oh Oh!';
$active_errors['message_503_title']		= '<title>503.. The 503 Service Unavailable page</title>
<meta name="description" content="503 service unavailable error for '.$active_errors['domain'].'" />
<meta name="keywords" content="503,error,503 error,503 service unavailable error" />';
$active_errors['message_503_sub']		= '
			This does not look good. More than likely '.$active_errors['webmaster'].' is messing around
			with the <a href="http://corz.org/serv/tricks/htaccess.php" title="Apache control" id="link_htaccess-tips"
			onclick="window.open(this.href); return false;"><code>.htaccess</code></a> files again, or something. Give it a moment or two and refresh,
			if you aren\'t in too much of a hurry.<br />
			<br />

			If this lasts, '.$active_errors['webmaster'].' would <strong>definitely</strong> like to <a href="'.
			$active_errors['email_address'].'?subject=503%20-%20'.rawurlencode($_SERVER['REQUEST_URI']).
			'" title="your valuable feedback is appreciated. thanks">hear about it</a>. Alternatively, click <a href="/"
			title="up to the site root">here</a> in the site root, which might still work, okay.';




/*
	Search Lock

	(protection against multiple simultaneous file searches)..

	404 doesn't allow users to bring the server down with multiple simultaneous file searches..
	there are bots, too, that delight in hitting non-existent 404's every single second.

	The system temp folder is usually good for a lock file - always world-writable, and
	generally on the system's fastest drive, perhaps even a ram drive or SSD.

	Or you can keep it inside your site, using the FULL path..
//$active_errors['lock_file'] = '/home/sites/corz.org/inc/sessions/404_lock';
																						*/
$active_errors['lock_file'] = '/tmp/404_lock';

// this will usually only kick in for crazy bots and web site abusers.
// on my live server and even my mirror, the site scan is completed in miliseconds, so most folk will never see this.
$active_errors['still_scanning_msg'] = "<small>404 is currently busy scanning the site for another lost document, try again in a moment</small>";




/*
end prefs	*/




/*
Experimental Prefs..	*/


// Embed error pages inside another page..
$active_errors['embedded'] = false;


// Logging errors to a file..
$active_errors['error_reporting'] = false;

// log to where..
$active_errors['error_file'] = $_SERVER['DOCUMENT_ROOT'].'/inc/log/.ht_errors';




/*

	Begin..
				*/


if (substr($_SERVER['REQUEST_URI'], -1) == '?') {
	die('improper request for non-existent page');
}


// default to 404 action..
$active_errors['error_type'] = 404;

// override with actual error type..
// without REDIRECT_STATUS, it all wonks..
if (isset($_SERVER['REDIRECT_STATUS'])) {
	$active_errors['error_type'] = $_SERVER['REDIRECT_STATUS'];
}



// It's a 404 error!
//
if ($active_errors['error_type'] == 404) {

	// First we do any "catchers", for pages that we have moved/redirected
	// Gotta do it first, as we are sending http "headers".

	// grab ini array, transform 'catchers' variable into an array of ini values
	$active_errors['catchers'] = parse_ini_file($active_errors['catchers']);

	while (list($old_page, $new_page) = each($active_errors['catchers'])) {

		if (stristr($_SERVER['REQUEST_URI'], $old_page)) {

			// wait for x seconds..
			usleep($active_errors['time_to_jump'] * 1000000);

			if ($active_errors['redirect_testing']) {
				header("HTTP/1.1 302 Temporary Redirect");
			} else {
				header("HTTP/1.1 301 Moved Permanently");
			}
			if (substr($new_page, 0, 4) == 'http') {
				header('Location: '.$new_page);
			} else {
				header('Location: http://'.$active_errors['domain'].$new_page);
			}
			die();
		}
	}

	// ok, we got a real 404 here.
	// probably..


	// let's search for the document..

	// init..
	$level = 0;
	$links_array = array();
	$full_name = '';
	$meta_refresh = '';
	$no_scan = false;

	// transform scan_path into an array..
	$active_errors['scan_path'] = array($active_errors['scan_path']);

	// grab the filename parts of the URL string, to be used later..
	$insert = rawurldecode(substr($_SERVER['REQUEST_URI'], (strrpos($_SERVER['REQUEST_URI'], '/')+1)));
	if ($insert == '') $insert = basename($_SERVER['REQUEST_URI']);
	if (strlen($insert) > 255)  $insert = substr($insert, 0, 255); // for levenshtein (i.e. some joker is having a laugh!)
	$insert_no_ext = substr($insert, 0, strrpos($insert, '.'));
	if ($insert_no_ext == '') $insert_no_ext = $insert; // folders, etc


	// ensure user ignore prefs are valid..
	$ignores = count($active_errors['ignore_folders']);
	for ($i=0; $i < $ignores; $i++) {
		if (substr($active_errors['ignore_folders'][$i], 0, 1) != '/') { $active_errors['ignore_folders'][$i] = '/'.$active_errors['ignore_folders'][$i]; }
		if (substr($active_errors['ignore_folders'][$i], -1) != '/') { $active_errors['ignore_folders'][$i] .= '/'; }
	}


	// attempt a scan-lock, and begin the scan..
	if(scan_lock($active_errors['lock_file'])) {
		scan_site();
		scan_unlock();
	} else {
		$no_scan = true;
		$active_errors['message_found_NO_matches'] = $active_errors['still_scanning_msg'];
	}


	// jump on single hit right now?
	if ((count($links_array) == 1) and ($active_errors['jump_on_single_hit'])) {

		switch (true) {

			case $active_errors['jump_method'] == '301':
				usleep($active_errors['time_to_jump'] * 1000000);
				header("HTTP/1.1 301 Moved Permanently");
				header("Location: $full_name");
				die();

			// don't use 307 unless you know what you are doing (passes POST variables onward, and many entities don't GET it!)
			case $active_errors['jump_method'] == '302' or $active_errors['jump_method'] == '307':
				usleep($active_errors['time_to_jump'] * 1000000);
				header('HTTP/1.1 '.$active_errors['jump_method'].' Temporary Redirect');
				header("Location: $full_name");
				die();

			case 'meta':
				$meta_refresh = '<meta http-equiv="refresh" content="'.round($active_errors['time_to_jump'], 0).';URL='.$full_name.'">';
		}
	}
} // end 404-specific code




/*
	Begin Page..
				*/


do_header();

  // you may want to put your header here
echo '
<div class="content-wide">
	<div class="two-column">
		<div class="left-column">';
echo '
			<h1>',$active_errors['message_'.$active_errors['error_type']],'</h1>
			',$active_errors['message_'.$active_errors['error_type'].'_sub'];
echo '
		</div>

		<div class="right-column">
			<div class="error">',$active_errors['error_type'],'</div>
		</div>';


if ($active_errors['error_type'] == 404) {

	echo '
	</div>
	<div class="clear">&nbsp;</div>';

	if ($meta_refresh) echo $meta_refresh;

	do_result('out');

	if ($links_page != '') {
		echo '
	<h2 id="found_matches">',$active_errors['message_found_matches'],'</h2>
		',$links_page,'
		<div class="tiny-space">&nbsp;</div>';
		if ($active_errors['corzoogle_always'] == true and !empty($active_errors['cz_location'])) corzoogle_box();
	} else {
		echo '
	<div id="found_NO_matches">
		<h2>',$active_errors['message_found_NO_matches'],'</h2>
	</div>';
		if (!$no_scan and $active_errors['cz_location']) corzoogle_box();
	}

	echo'
	<div class="half-space">&nbsp;</div>';

} else {
	echo '
	</div>';
}


echo '
</div>';

end_error_page();



/*
	functions..	  */


// show the corzoogle search form..
function corzoogle_box() {
global $active_errors, $insert_no_ext;
	$insert_no_ext = strip_stuff(urldecode($insert_no_ext));
	echo '
<h4>',$active_errors['message_do_a_search'],'</h4>

<div class="centered">
	<a href="http://corz.org/corzoogle/" onclick="window.open(this.href); return false;" title="corzoogle locates! (opens in a new window - Apple|Ctrl|whatever-click for a new tab instead)">
	<img src="',$active_errors['cz_img_location'],'" alt="corzoogle locates!" /></a><br />
	<br />
	<form method="get" action="',$active_errors['cz_location'],'">
	<div class="form">
		<input type="text" name="q" size="21" maxlength="256" value="',stripslashes($insert_no_ext),'" />
		&nbsp;
		<input type="submit" value="do it!" />
	</div>
	</form>
	<div class="small-space">&nbsp;</div>
</div>';
}


// attempt to achieve a scan lock.
// return true if successful..
function scan_lock($lock_file) {

	clearstatcache();
	// check existence of lock file..
	if (file_exists($lock_file)) {
		$lock_age = filectime($lock_file);

		// if exists, check date/time
		if ((time() - filectime($lock_file)) > 60) {
			// if older than one minute, delete it..
			// (something bad must have happened elsewhere)
			unlink($lock_file);
		} else {
			return false;
		}
	}

	// set lock file..
	$fp = fopen($lock_file, 'wb');
	if (is_writable($lock_file)) {
		if ($fp) {
			$GLOBALS['locked'] = flock($fp, LOCK_EX);
			if ($GLOBALS['locked']) {
				// clearer than fputs, same function..
				fwrite($fp, '1');		// could put their IP in here. hmm. perhaps a lock "folder" one lock for each IP, or 1 file per IP
				//flock ($fp, LOCK_UN);	// but then system /tmp/ may not allow folder creation. hmm.
			}
			fclose($fp); // this releases the file lock!
		}
	}

	// if all is well, return success..
	if (file_exists($lock_file)) {
		return true;
	} else {
		return false;
	}
}


/*
function:scan_site()
for more comments, see corzoogle.php  spider() */
function scan_site() {
global $active_errors, $insert, $insert_no_ext, $level;


	if (!$active_errors['exact_match']) $insert = $insert_no_ext;
	for ($search=0,$search_path=''; $search <= $level; $search++) {
		$search_path .= $active_errors['scan_path'][$search];
		$search_path = str_replace($active_errors['ignore_folders'], '', $search_path);
	}

	$dirhandle = opendir($search_path);
	while ($file = readdir($dirhandle)) {

		if ($file{0} != '.') {

			if (is_file($search_path.$file)) {
				$fext = substr($file,strrpos($file,'.'));
				$itsname = basename($file);
				$short_name = substr($itsname, 0, 0 - strlen($fext));

				if (($active_errors['partial_match']) and (in_array($fext, $active_errors['allowed_extensions']) and (@stristr($file, $insert)))) {
						do_result($search_path.$file);

				} elseif ($active_errors['fuzzy_match']) {
					if (in_array($fext, $active_errors['allowed_extensions'])
						// first we test if a single change gives a match
						and (similar_text($short_name, $insert) == strlen($short_name)-1)
							// and test that it's a single replacement..
							and levenshtein($short_name, $insert) <= $active_errors['fuzziness_level']) {
							// using two tests allows us to match for dodgy, non-letter
							// characters and makes things more accurate.
						do_result($search_path.$file);
					}
				} else {

					// non-fuzzy or partial match..
					if (in_array($fext, $active_errors['allowed_extensions']) and (@stristr($itsname, $insert))) {
						do_result($search_path.$file);
					}
				}
			} elseif (is_dir($search_path.$file)) {
				if ($active_errors['match_dirs'] and (!in_array($search_path.$file, $active_errors['ignore_folders'])) and @stristr($search_path.$file, $insert)) do_result($search_path.$file);
				$active_errors['scan_path'][++$level] = ($file.'/');
				scan_site();
				$level--;
			}
		}
	}
}/*	end function:scan_site()
*/



function scan_unlock() {			// Don't lock, so that we can read it later for time info!!!!! r8? :/
global $active_errors;

	// unlock the lock file..
	if ($GLOBALS['locked']) { @flock($fp, LOCK_UN); }
	// delete lock file
	$deleted = @unlink($active_errors['lock_file']); // @ in case (and this has happened) the system cleaned up the lock file during the scan
}



/*
function do_result()	*/
function do_result($file) {
global $active_errors, $full_name, $links_page, $links_array;

	if ($file == 'out') {
		// output the page
		foreach($links_array as $link) {
			$links_page .= $link;
		}
	} else {
		$display_name = $title = basename($file);
		$full_name = str_replace($active_errors['scan_path']{0},'http://'.$active_errors['domain'].'/',$file);
		if ($active_errors['links_are_full']) { $display_name = $full_name; }
		array_push($links_array, '<a href="'.$full_name.'" title="'.$display_name.'">'.$display_name."</a><br />\n");
	}
}/*	end function do_result()
*/


/*
function strip_stuff() 	*/
function strip_stuff($string) {

	$nonos = array('.','..',' .'.'. ',',',';','[',']','*','~','#','&','?','$','%','+','=','»','«');
	$stripped = str_replace($nonos, ' ', $string);	// remove undesirables

	return trim($stripped);
}/*
end function strip_stuffing() 	*/



// header/footer parts..
//

function do_header() {
	global $active_errors;
	if ($active_errors['embedded']) { return; }
	echo'<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">';
	echo $active_errors['message_'.$active_errors['error_type'].'_title'];

	echo '
<!--[if lt IE 9]><script src=http://html5shim.googlecode.com/svn/trunk/html5.js></script><![endif]-->
<style media="screen">
/*<![CDATA[*/';
echo '
@import "',$active_errors['css_location'],'";
/*]]>*/
</style>
</head>
<body>
<!-- A part of Active Error Pages, the non-existent files file, from http://corz.org/serv/tools/ .. -->
<div class="quarter-space">&nbsp;</div>';
}


function end_error_page() {

	global $active_errors;

	// optional error reporting..
	if ($active_errors['error_reporting']) {
		log_errors();
	}

	// do your footer thang here.
	//include 'footer.php';

	// gotta leave my link in, that's the deal!
	echo '
<div class="toplink">
	<a href="http://corz.org/engine?section=php" onclick="window.open(this.href); return false;"
	title="a parth of the non-existent file file.. Active Error Pages, from corz.org">get the source</a>
</div>';

	if (!$active_errors['embedded']) {
		echo '
</body>
</html>';
	}
}


function log_errors() {

	global $active_errors;

	// it's not there, try to create it..
	if (!file_exists($active_errors['error_file'])) {
		$fp = fopen($active_errors['error_file'], 'wb');
	}

	if (file_exists($active_errors['error_file'])) {
		$errors_oops = chr(10).date('Y.m.d h:i:s A')
		.chr(9).$_SERVER['REMOTE_ADDR']
		.chr(9).basename($_SERVER['SCRIPT_NAME'])
		.chr(9).@$_SERVER['HTTP_REFERER']
		.chr(9).$_SERVER['REQUEST_URI']
		.chr(9).@$_SERVER['HTTP_USER_AGENT'];

		// add this entry..
		$fp = fopen($active_errors['error_file'], 'ab');
		fwrite($fp, $errors_oops);
		fclose($fp);
	}
}


/*
	mail_mash()

	a cuter way to foil the spam-bots

	mail_mash will transform email@address.com into a randomly mixed string of real
	"o" and encoded "&#111;" characters. it's different each time the page loads,
	but always presents a valid mailto:email@address.com for a human clicker

	note: the "mailto:" part is also prepended, mixed in to the randomness, so you
	don't need to provide that in your html, just <a href="',mail_mash($email_address),'">
	from inside a php echo, or put a whole php echo statement inside the href if you
	are inside plain html

		your@address.com

	would output *something like*..

		&#109;a&#105;&#108;to:&#121;our&#64;a&#100;&#100;r&#101;ss.&#99;&#111;&#109;

	have fun!

*/
function mail_mash($addy) {

	$addy = 'mailto:'.$addy;
	for($i=0;$i<strlen($addy);$i++) { $letters[] = $addy[$i]; }

	while (list($key, $val) = each($letters)) {
		$r = rand(0,20);
		if ($r > 9) { $letters[$key] = '&#'.ord($letters[$key]).';';}
	}

$mashed_email_addy = implode('', $letters);
return $mashed_email_addy;

}/*
end function mail_mash()	*/





/*
	changes..

	I thought I might start keeping changes under the scripts themselves.
	it doesn't cost us anything. php will ignore this.


		2.1

		*	Added a routine to ensure user ignore prefs are valid (omitting a
			slash will put AEP into a loop).

		2.0

		*	Active Error pages is now an all-in-one script, a single php file
			with settings at the top, handling all your error pages automatically.

		*	HTML5 output.

		*	and more!


							---^---	Active Error Pages ---^---

		1.9.16

		*	As well as specify a global domain for all catchers redirects, you can enter
			the full URL into the ini - 404 will see the http*something and use your
			entire string as the redirect URL.


		1.9.15

		*	central config file: error-settings.php

		*	removed some left-over branding

		*	Added matching 400, 410 and 503 pages


		1.9.11

		*	In the event of the site scan turning up a single match, 404 can now
			redirect with a proper 301 header, just like the catchers. Most
			users wouldn't even realize they got a 404. This basically gives you
			automatic 301 permanent redirects for any pages you move. keep the
			users and spiders happy!

		*	You now can specify the catchers auto-jump method, '301', or
			old-school meta-refresh, in the preferences.

		*	Added scan locking. When 404 is scanning the site, it will place a
			temporary lock file, to prevent crazy bots and site abusers from
			running multiple file scans at once, and potentially stressing the
			server, chewing up resources.

			404 will still display, but with a message telling the user to wait
			a moment before trying again, rather than the usual search results.
			Most folk will never see this in action, but it's good to know it's
			there, preventing potential mishaps.

		*	You can now choose to have 404 return matches for directories.
			so if the user was looking for the non-existent/foo/hell they could
			get back results for /bar/shell scripts/

		*	Fixed the slashes in the corzoogle input (for '' quotes).


		1.8

		*	fixed the corzoogle image location, and some other stuff.

		*	Cleaned up distro prefs.

		*	Improved layout, now uses a nice container like my regular pages


		1.7

		*	incorporated partial matching and fuzzy matching; produces great
			results.

		*	cleaned up some xhtml output


		1.6.5

		*	Added some fuzzy matching for the file scan. A sorta request.

		*	this is a highly specialized tweak, but works great as per request.
			you can play around with things to get different results, but as it
			stands, g-dip will match g_dip.jpg, and in my own mirror,
			tempz_piles will match tempx_piles.jpg, etc. This can be
			enabled/disabled from a preference called $active_errors['fuzzy_match'].


		1.6.2-1.6.4

		*	just minor things.


		1.6.2:

		*	Fixed some potential bugs in initialisation.


		1.6.1:

		*	XHTML 1.0 Strict compliance. Nice.


		1.6:

		*	404 will now strip characters from the input string for entry into
			the corzoogle search box. for instance, a 404 for mama.mia.php will
			now enter "mama mia" into the search box, instead of "mama.mia"
			which would likely produce a lot less hits. corzoogle, of course,
			takes the dot into account

			Added some information to the readme up top, including important
			notes about editing the redirections. I discovered this the hard
			way.



		:2do..

			lost songs
			redirect lost *.mp3 (or whatever) to a special page
			like the /audio/ root.

*/
?>