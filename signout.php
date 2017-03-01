<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

setcookie('EMAIL','',time()-60*60*24*7);
setcookie('RULE','',time()-60*60*24*7);

header('Location: index.phtml');