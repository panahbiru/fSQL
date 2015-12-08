<?php require("./header.php"); ?>

<h1>Flat-File SQL</h1>

<p>Welcome to the home of <strong>Flat-File SQL</strong>!  Flat-File SQL (or fSQL for short) 
is a way to use SQL queries without having another database (like mySQL) installed.  It uses 
regular files that you store wherever you want.  At the moment, there is only a PHP version, but a perl version
and possibly other language ports are planned.</p>


<h2>Features and Benefits</h2>


<div class="floatbox">
  <hr />
  <p class="title">Latest Releases</p>

  <p>PHP Version 1.3.1<br />
	Released: December 4, 2008</p>

  <p>PHP Version 1.3<br />
	Released: October 31, 2008
  </p>

  <p>PHP Version 1.2<br />
	Released: April 25, 2006
  </p><hr />
</div>


<p>There are several advantages to using fSQL over regular flat-files:</p>

<ul>

  <li><p>fSQL allows you to take advantage of SQL queries to
easily manipulate and extract data without having to do it manually
using the native file API.</p></li>
  
  <li><p>fSQL has a fully
object-oriented API in which the methods are similiar to the mySQL API
to avoid a lot of changes. This allows a program designed for mySQL to
easily be ported to a flat-file system without any drastic changes.</p></li>

  <li><p>fSQL supports all the essential SQL commands and mimics mySQL syntax and features as fully as possible.</p></li>

  <li><p>fSQL offers some new and rare query commands such as SEARCH and MERGE to simplify other normally long tasks.</p></li>

</ul>

<?php require("./footer.php"); ?>
