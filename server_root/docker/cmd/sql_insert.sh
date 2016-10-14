#!/bin/bash

set -x


folder_id=
customer_type
customer_id="123"
customer_name="Yuji"
customer_ruby="AAA"
customer_juniorhighschool=""
customer_club=""
customer_couple=""
customer_role=""
customer_postcode="2760022"
customer_address=""
customer_addressruby=""
customer_phone=""
customer_graduate=""
customer_mobile=""
customer_email="ogihara@gmail.com"
customer_gender=""
customer_comment=""
customer_role=""
customer_annualfee=""

docker exec -it tt-server mysql -uroot db -e "INSERT INTO customer_customer ( folder_id,customer_type,customer_id,customer_name,customer_ruby,customer_gender,customer_graduate,customer_email,customer_phone,customer_mobile,customer_postcode,customer_address,customer_addressruby,customer_juniorhighschool,customer_club,customer_couple,customer_role,customer_annualfee,customer_party,customer_comment) VALUES ('$folder_id','$customer_type','$customer_id','$customer_name','$customer_ruby','$customer_gender','$customer_graduate','$customer_email','$customer_phone','$customer_mobile','$customer_postcode','$customer_address','$customer_addressruby','$customer_juniorhighschool','$customer_club','$customer_couple','$customer_role','$customer_annualfee','$customer_party','$customer_comment')" 




