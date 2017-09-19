<?php if(!defined('KIRBY')) exit ?>

title: Projects
files: false
pages:
  template: project
  limit: 50
deletable: false
fields:
  title:
    label: Title
    type:  text
  pageindex:
    label: Items
    type: index
    options: children
    columns:
      title: Title
      category: Category
      uid: Slug
  sortable:
    label: Visual sorting
    type:  sortable
    layout:  base
    variant: null
    limit: false
    parent: null
    prefix: null
    options:
      limit: false