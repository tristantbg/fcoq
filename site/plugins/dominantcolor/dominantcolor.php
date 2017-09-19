<?php

require 'vendor/autoload.php';

use ColorThief\ColorThief;
//use League\ColorExtractor\Color;
//use League\ColorExtractor\ColorExtractor;
//use League\ColorExtractor\Palette;

function contrast( $rgb ) {
	return sqrt(
        		$rgb[0] * $rgb[0] * .241 +
        		$rgb[1] * $rgb[1] * .691 +
        		$rgb[2] * $rgb[2] * .068
    		);
}

function rgbToHsl( $rgb ) {
	$r = $rgb[0];
	$g = $rgb[1];
	$b = $rgb[2];
	$oldR = $r;
	$oldG = $g;
	$oldB = $b;
	$r /= 255;
	$g /= 255;
	$b /= 255;
    $max = max( $r, $g, $b );
	$min = min( $r, $g, $b );
	$h;
	$s;
	$l = ( $max + $min ) / 2;
	$d = $max - $min;
    	if( $d == 0 ){
        	$h = $s = 0; // achromatic
    	} else {
        	$s = $d / ( 1 - abs( 2 * $l - 1 ) );
		switch( $max ){
	            case $r:
	            	$h = 60 * fmod( ( ( $g - $b ) / $d ), 6 ); 
                        if ($b > $g) {
	                    $h += 360;
	                }
	                break;
	            case $g: 
	            	$h = 60 * ( ( $b - $r ) / $d + 2 ); 
	            	break;
	            case $b: 
	            	$h = 60 * ( ( $r - $g ) / $d + 4 ); 
	            	break;
	        }			        	        
	}
	return array( round( $h, 2 ), round( $s, 2 ), round( $l, 2 ) );
}

function filterAndSaveColors($colors, $image) {
	foreach ($colors as $key => $rgb) {
			$hsl = rgbToHsl($rgb);
    		if ($hsl[1] > 50 && $hsl[2] > 40 && $hsl[2] < 80) {
				$hex_main_color = sprintf("#%02x%02x%02x", $rgb[0], $rgb[1], $rgb[2]);

				// Update image metadata
				$image->update(array(
					'color'.$i    => $hex_main_color
				));

				$i++;
    		}
		}
}

function resetAllImages() {
	$images = new ArrayObject();
	foreach (site()->index() as $c) {
		foreach ($c->images() as $i) {
			$images->append($i);
		}
	}

	foreach ($images as $key => $image) {
	// Create thumb for faster processing
		$thumb = $image->thumb([
			'width'   => 400,
			'imagekit.lazy' => false,
			'imagekit.optimize' => false
			]);

		$colors = ColorThief::getPalette($thumb->root(), 10);
		$i = 0;
		filterAndSaveColors($colors, $image);
	}
}

kirby()->hook(['panel.file.upload', 'panel.file.replace'], function($image) {
  if ($image->type() == 'image') {
    // Create thumb for faster processing
    $thumb = $image->thumb([
      'width'   => 400,
      'imagekit.lazy' => false,
      'imagekit.optimize' => false
    ]);

		// Extract main color
		//$palette = Palette::fromFilename($thumb->root());
		//$extractor = new ColorExtractor($palette);
		//$colors = $extractor->extract(5);
    	$colors = ColorThief::getPalette($thumb->root(), 10);
    	$i = 0;
		filterAndSaveColors($colors, $image);
		
  }

  // RESETS ALL IMAGES

  //resetAllImages();

});
