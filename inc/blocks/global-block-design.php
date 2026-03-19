<?php

function block_design_content_width() {
  switch ( get_sub_field('block_design_content_width') ) {
    case 'full_width':
      return 'col';
      break;
    case 'wide':
      return 'col-lg-9';
      break;
    case 'narrow':
      return 'col-lg-6';
      break;
    default:
      return 'col';
      break;
  } 
}

function block_design_content_alignment() {
  switch ( get_sub_field('block_design_content_alignment') ) {
    case 'left':
      return 'justify-content-start';
      break;
    case 'center':
      return 'justify-content-center';
      break;
    case 'right':
      return 'justify-content-end';
      break;
    default:
      return 'justify-content-start';
      break;
  } 
}

function block_design_gap_top() {
  switch ( get_sub_field('block_design_gap_top') ) {
    case 'small':
      return 'mt-5';
      break;
    case 'medium':
      return 'mt-5 mt-lg-7';
      break;
    case 'large':
      return 'mt-7 mt-lg-9';
      break;
    default:
      return '';
      break;
  } 
}

function block_design_gap_bottom() {
  switch ( get_sub_field('block_design_gap_bottom') ) {
    case 'small':
      return 'mb-5';
      break;
    case 'medium':
      return 'mb-5 mb-lg-7';
      break;
    case 'large':
      return 'mb-7 mb-lg-9';
      break;
    default:
      return '';
      break;
  } 
}

function block_design_padding_top() {
  switch ( get_sub_field('block_design_padding_top') ) {
    case 'small':
      return 'pt-5';
      break;
    case 'medium':
      return 'pt-5 pt-lg-7';
      break;
    case 'large':
      return 'pt-7 pt-lg-9';
      break;
    default:
      return '';
      break;
  } 
}

function block_design_padding_bottom() {
  switch ( get_sub_field('block_design_padding_bottom') ) {
    case 'small':
      return 'pb-5';
      break;
    case 'medium':
      return 'pb-5 pb-lg-7';
      break;
    case 'large':
      return 'pb-7 pb-lg-9';
      break;
    default:
      return '';
      break;
  } 
}

function block_design_background_colour() {
  switch ( get_sub_field('block_design_background_colour') ) {
    case 'primary':
      return 'bg-primary';
      break;
    case 'light':
      return 'bg-light';
      break;
    case 'dark':
      return 'bg-dark';
      break;
    case 'light_grey':
      return 'bg-graylighter';
      break;
    default:
      return '';
      break;
  }
}