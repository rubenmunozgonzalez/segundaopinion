<?php
return array(
    // set your paypal credential
    'client_id' => 'AZJJdL-8-QV8KJRV6p4zK14o2t4k0iYw14JRAyVg_C-GuzqiOLJIlXLFgYlBvmaZ39oVySUBOt_OxrdP',
    'secret' => 'EONaDXTYmeiSab5nA5BSPHdce6LerXzpILNprLzaOuuT0Jb1PISWkSePTqWv-JuPyaZPISyBgkfx3sGn',
 
    /**
     * SDK configuration 
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',
 
        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,
 
        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,
 
        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',
 
        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'ERROR'
    ),
);
