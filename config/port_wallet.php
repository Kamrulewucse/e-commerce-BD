<?php

return [
    //Port Wallet
    "port_wallet_mode"       => env("PORT_WALLET_MODE","sandbox"),
    "port_wallet_api_key"       => env("PORT_WALLET_API_KEY",""),
    "port_wallet_api_secret"       => env("PORT_WALLET_API_SECRET",""),
    "port_wallet_redirect_url"       => env("PORT_WALLET_REDIRECT_URL","http://localhost"),
    "port_wallet_redirect_ipn_url"     => env("PORT_WALLET_REDIRECT_IPN_URL", "http://localhost"),

];
