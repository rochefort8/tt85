#!/bin/bash

set -x

customer_name="Yuji"


folder_id=
customer_type=
customer_name=""
customer_ruby=""
customer_juniorhighschool=""
customer_club=""
customer_couple=""
customer_role=""
customer_postcode=""
customer_address=""
customer_addressruby=""
customer_phone=""
customer_graduate=""
customer_mobile=""
customer_email=""
customer_id=""
customer_gender=""
customer_comment=""
customer_role=""
customer_annualfee=""


docker exec -it tt-server mysql -uroot db -e "INSERT INTO customer_customer ( folder_id,customer_type,customer_id,customer_name,customer_ruby,customer_gender,customer_graduate,customer_email,customer_phone,customer_mobile,customer_postcode,customer_address,customer_addressruby,customer_juniorhighschool,customer_club,customer_couple,customer_role,customer_annualfee,customer_party,customer_comment) VALUES ('','','','$customer_name','','','','','','','','','','','','','','','','')"


