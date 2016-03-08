Monolog GeoIP processor
====

A GeoIP processor for your monolog' logs, the processor will append the following values from $_SERVER (or configured source) 
    
    extra.geo_city = 'Roubaix'
    extra.geo_country = 'FR'
    extra.geo_point = [ // geojson point format
        50.6887078, // longitude
        3.1492011 // latitude
    ]

     
