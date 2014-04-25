-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 23, 2013 at 11:52 PM
-- Server version: 5.5.32-cll
-- PHP Version: 5.3.17


--
-- Database: `xooscrip_xoousersdev`
--

-- --------------------------------------------------------

--
-- Table structure for table `xoodigital_visitor_stats`
--

CREATE TABLE IF NOT EXISTS `xoodigital_visitor_stats` (
  `stat_id` int(11) NOT NULL AUTO_INCREMENT,
  `stat_date` date NOT NULL,
  `stat_ip` varchar(100) NOT NULL,
  PRIMARY KEY (`stat_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `xoousers_email_templates`
--

CREATE TABLE IF NOT EXISTS `xoousers_email_templates` (
  `template_id` int(11) NOT NULL AUTO_INCREMENT,
  `template_name` varchar(250) NOT NULL,
  `template_text` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`template_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `xoousers_ip_blocking`
--

CREATE TABLE IF NOT EXISTS `xoousers_ip_blocking` (
  `ip_id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(100) NOT NULL,
  `ip_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ip_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `xoousers_members`
--

--
-- Table structure for table `xoousers_members`
--

CREATE TABLE IF NOT EXISTS `xoousers_members` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_role_id` varchar(100) NOT NULL DEFAULT '1',
  `member_name` varchar(250) NOT NULL,
  `member_user` varchar(250) NOT NULL,
  `member_registration_type` int(1) NOT NULL DEFAULT '1',
  `member_fb` varchar(250) NOT NULL,
  `member_avatar` varchar(200) NOT NULL,
  `member_email` varchar(250) NOT NULL,
  `member_pass` varchar(250) NOT NULL,
  `member_hash` varchar(300) NOT NULL,
  `member_activation_string` varchar(50) NOT NULL,
  `member_creation_date` datetime NOT NULL,
  `member_activation_date` date NOT NULL,
  `member_last_ip` varchar(60) NOT NULL,
  `member_last_date` datetime NOT NULL,
  `member_status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`member_id`),
  UNIQUE KEY `member_user` (`member_user`),
  UNIQUE KEY `member_email` (`member_email`),
  UNIQUE KEY `member_hash` (`member_hash`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `xoousers_roles`
--

CREATE TABLE IF NOT EXISTS `xoousers_roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(250) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `xoousers_settings`
--

CREATE TABLE IF NOT EXISTS `xoousers_settings` (
  `setting_group` varchar(100) NOT NULL,
  `setting_label` varchar(100) NOT NULL,
  `setting_name` varchar(150) NOT NULL,
  `setting_clarify` varchar(250) NOT NULL,
  `setting_values` text NOT NULL,
  `setting_field_type` enum('text','radio') NOT NULL DEFAULT 'text',
  `setting_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`setting_group`,`setting_label`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `xoousers_stats`
--

CREATE TABLE IF NOT EXISTS `xoousers_stats` (
  `stat_module` varchar(100) NOT NULL,
  `stat_item_id` int(11) NOT NULL,
  `stat_date` date NOT NULL,
  `stat_ip` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xoousers_users`
--

CREATE TABLE IF NOT EXISTS `xoousers_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_username` varchar(250) NOT NULL,
  `user_email` varchar(250) NOT NULL,
  `user_password` varchar(250) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
