Updated: Background
====================

Return all the image names from a specific folder based on an data attribute.

Install
=======

Download and replace 'background.php' with the downloaded file:

Usage
=====

Then within your javascript you'll need to place the following in the 'init' function:
```
if($('.banner').size() > 0) {
	$('.banner').each(function() {
		banner($(this));
	});
}
```
(Or something similar, which triggers a function when it finds the element)

Once that's completed, you'll need to place this as the banner function:
```
banner = function(e) {
	var folder = e.data('folder');
	$.ajax({
		url: '/background/images.json?folder='+folder,
		success: function(data) {
			var images = data.images;
			e.backstretch(images);
		},
		error: function(data) {
			console.log(data.message);
		}
	});
};
```
(Or something similar to get the results and then display them)

This demo is based on [Backstretch](http://srobbin.com/jquery-plugins/backstretch/)

HTML
=======

Once this is done, you can just call the following HTML
```
<section class="banner" data-folder="{Folder name here}"></section>
```

Structure
=========

The plugin works out of the box by getting the files from:
```
/assets/img/transitions/ {Folder name here} /
```