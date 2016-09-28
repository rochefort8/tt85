#!/bin/bash
scp ./tochikukai.sql tochikukai.com:~/tt
ssh tochikukai.com ./tt/upload_from_aws.sh
