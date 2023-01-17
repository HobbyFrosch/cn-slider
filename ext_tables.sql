#
# Table structure for table 'tt_content'
#

CREATE TABLE tt_content (

	tx_cnslider_height VARCHAR (255) NULL,
	tx_cnslider_show_in_menu TINYINT NOT NULL DEFAULT 0,
	tx_cnslider_nav_title VARCHAR (255) NULL,
	tx_cnslider_video_url VARCHAR (255) NULL,
	tx_cnslider_member_picture int(11) DEFAULT '0' NOT NULL,
	tx_cnslider_event int(11) DEFAULT '0' NOT NULL

);

#
# Table structure for table 'tx_cnslider_member_picture'
#

CREATE TABLE tx_cnslider_member_picture (

    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    tx_cnslider_member_name varchar(255) NOT NULL,
    tx_cnslider_member_description text,
    tx_cnslider_member_picture int(11) unsigned DEFAULT '0',
    tt_content_id int(11) DEFAULT '0' NOT NULL,

    tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
    deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
    hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
    starttime int(11) unsigned DEFAULT '0' NOT NULL,
    endtime int(11) unsigned DEFAULT '0' NOT NULL,

    t3ver_oid int(11) DEFAULT '0' NOT NULL,
    t3ver_id int(11) DEFAULT '0' NOT NULL,
    t3ver_wsid int(11) DEFAULT '0' NOT NULL,
    t3ver_label varchar(255) DEFAULT '' NOT NULL,
    t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
    t3ver_stage int(11) DEFAULT '0' NOT NULL,
    t3ver_count int(11) DEFAULT '0' NOT NULL,
    t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
    t3ver_move_id int(11) DEFAULT '0' NOT NULL,
    sorting int(11) DEFAULT '0' NOT NULL,
    t3_origuid int(11) DEFAULT '0' NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid),
    KEY t3ver_oid (t3ver_oid,t3ver_wsid)

);

#
# Table structure for table 'tx_cnslider_event'
#
CREATE TABLE tx_cnslider_event (

    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    tx_cnslider_event_name varchar(255) NOT NULL,
    tx_cnslider_event_date int(11) DEFAULT '0',
    tx_cnslider_event_content text,
    tx_cnslider_event_image int(11) unsigned DEFAULT '0',
    tx_cnslider_event_location varchar(255) DEFAULT '0',
    tx_cnslider_event_location_name varchar(255) DEFAULT '0',
    tt_content_id int(11) DEFAULT '0' NOT NULL,
    tx_cnslider_event_highlight TINYINT(1) NOT NULL DEFAULT '0',

    tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
    deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
    hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
    starttime int(11) unsigned DEFAULT '0' NOT NULL,
    endtime int(11) unsigned DEFAULT '0' NOT NULL,

    t3ver_oid int(11) DEFAULT '0' NOT NULL,
    t3ver_id int(11) DEFAULT '0' NOT NULL,
    t3ver_wsid int(11) DEFAULT '0' NOT NULL,
    t3ver_label varchar(255) DEFAULT '' NOT NULL,
    t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
    t3ver_stage int(11) DEFAULT '0' NOT NULL,
    t3ver_count int(11) DEFAULT '0' NOT NULL,
    t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
    t3ver_move_id int(11) DEFAULT '0' NOT NULL,
    sorting int(11) DEFAULT '0' NOT NULL,
    t3_origuid int(11) DEFAULT '0' NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid),
    KEY t3ver_oid (t3ver_oid,t3ver_wsid)

);
