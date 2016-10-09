CREATE TABLE prefix_user (
id integer NOT NULL PRIMARY KEY auto_increment,
userid text NOT NULL,
password text NOT NULL,
password_default text NOT NULL,
realname text NOT NULL,
authority text NOT NULL,
user_group integer,
user_groupname text,
user_email text,
user_skype text,
user_ruby text,
user_postcode text,
user_address text,
user_addressruby text,
user_phone text,
user_mobile text,
user_order integer,
edit_level integer,
edit_group text,
edit_user text,
owner text NOT NULL,
editor text,
created text NOT NULL,
updated text);
CREATE UNIQUE INDEX prefix_index_userid ON prefix_user (userid(255));
CREATE INDEX prefix_index_user_group ON prefix_user (user_group);

CREATE TABLE prefix_group (
id integer NOT NULL PRIMARY KEY auto_increment,
group_name text NOT NULL,
group_order integer,
add_level integer NOT NULL,
add_group text,
add_user text,
edit_level integer,
edit_group text,
edit_user text,
owner text NOT NULL,
editor text,
created text NOT NULL,
updated text);

CREATE TABLE prefix_folder (
id integer NOT NULL PRIMARY KEY auto_increment,
folder_type text NOT NULL,
folder_id integer NOT NULL,
folder_caption text NOT NULL,
folder_name text,
folder_date text,
folder_order integer,
add_level integer,
add_group text,
add_user text,
public_level integer,
public_group text,
public_user text,
edit_level integer,
edit_group text,
edit_user text,
owner text NOT NULL,
editor text,
created text NOT NULL,
updated text);
CREATE INDEX prefix_index_folder_type ON prefix_folder (folder_type(255));
CREATE INDEX prefix_index_folder_id ON prefix_folder (folder_id);
CREATE INDEX prefix_index_folder_owner ON prefix_folder (owner(255));

CREATE TABLE prefix_customer (
id integer NOT NULL PRIMARY KEY auto_increment,
folder_id integer NOT NULL,
customer_type integer NOT NULL,
customer_name text,
customer_ruby text,
customer_juniorhighschool text,
customer_club text,
customer_department text,
customer_position text,
customer_postcode text,
customer_address text,
customer_addressruby text,
customer_phone text,
customer_graduate text,
customer_mobile text,
customer_email text,
customer_url text,
customer_comment text,
customer_parent integer,
customer_item00 text,
customer_item01 text,
customer_item02 text,
customer_item03 text,
customer_item04 text,
customer_item05 text,
customer_item06 text,
customer_item07 text,
customer_item08 text,
customer_item09 text,
owner text NOT NULL,
editor text,
created text NOT NULL,
updated text);
CREATE INDEX prefix_index_customer_folder_id ON prefix_customer (folder_id);
CREATE INDEX prefix_index_customer_type ON prefix_customer (customer_type);

CREATE TABLE prefix_history (
id integer NOT NULL PRIMARY KEY auto_increment,
folder_id integer NOT NULL,
customer_id integer NOT NULL,
customer_type integer,
customer_name text,
history_item00 text,
history_item01 text,
history_item02 text,
history_item03 text,
history_item04 text,
history_item05 text,
history_item06 text,
history_item07 text,
history_item08 text,
history_item09 text,
history_item10 text,
history_item11 text,
history_item12 text,
history_item13 text,
history_item14 text,
history_item15 text,
history_item16 text,
history_item17 text,
history_item18 text,
history_item19 text,
owner text NOT NULL,
editor text,
created text NOT NULL,
updated text);
CREATE INDEX prefix_index_history_folder_id ON prefix_history (folder_id);
CREATE INDEX prefix_index_history_customer_id ON prefix_history (customer_id);

CREATE TABLE prefix_item (
id integer NOT NULL PRIMARY KEY auto_increment,
folder_id integer NOT NULL,
item_type text NOT NULL,
item_field text NOT NULL,
item_caption text,
item_input text,
item_property text,
item_null text,
item_display integer,
item_order integer,
owner text NOT NULL,
editor text,
created text NOT NULL,
updated text);
CREATE INDEX prefix_index_item_folder_id ON prefix_item (folder_id);
CREATE INDEX prefix_index_item_type ON prefix_item (item_type(255));
CREATE INDEX prefix_index_item_field ON prefix_item (item_field(255));

CREATE TABLE prefix_config (
id integer NOT NULL PRIMARY KEY auto_increment,
config_type text NOT NULL,
config_key text NOT NULL,
config_value text,
owner text NOT NULL,
editor text,
created text NOT NULL,
updated text);
CREATE INDEX prefix_index_config_type ON prefix_config (config_type(255));
