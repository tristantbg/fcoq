<?php if(!defined('KIRBY')) exit ?>

title: Project
files: true
pages: false
files:
  fields:
    videolink:
      label: Video Link
      type: url
      help: Youtube or Vimeo
    videofile:
      label: Video File
      type: select
      options: videos
    contentsize:
      label: Size
      type: radio
      default: large
      options:
        small: Small
        medium: Medium
        large: Large
      columns: 3
fields:
  prevnext: prevnext
  title:
    label: Title
    type:  text
    width: 1/2
  subtitle:
    label: Subtitle
    type: text
    width: 1/2
  featured:
    label: Featured image
    type: image
    help: Required to display project
    width: 1/4
  date:
    label: Year
    type:  date
    format: YYYY
    required: true
    width: 1/4
  client:
    label: Client
    type:  text
    width: 2/4
  text:
    label: Description
    type: textarea
  medias: 
    label: Images
    type: gallery
