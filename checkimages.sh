#!/bin/sh
# download missing images from superdesk
# generate CSV with filename from SWP Databae with SQL like:
#
# select concat(si.asset_id, '.', si.file_extension) from swp_article as sa
# join swp_article_media sam on sa.id = sam.article_id
# join swp_image si on sam.image_id = si.id
# where sa.tenant_code = 'b94k0f'
# and sa.created_at between '2020-05-01' and '2020-11-04'
# order by sa.published_at
#
# Execute script in publishers image upload folder, that for Funke Digital Organisation:
# /var/www/publisher/public/uploads/swp/sxl34v/media
#
# https://superdesk.cloud.funkedigital.de/api/upload-raw/5d6673578e101d43f9957520.jpeg

while read -r line
do
    if [ ! -f "$line" ]; then
      wget "https://superdesk-stage.cloud.funkedigital.de/api/upload-raw/$line"
    fi

done < wmn_images.csv
