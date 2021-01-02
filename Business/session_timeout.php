<?php

session_set_cookie_params(time() + 1800);
session_set_cookie_params(['samesite' => 'strict']);

