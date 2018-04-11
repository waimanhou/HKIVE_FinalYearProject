<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function smarty_function_getTicket($params, &$smarty) {
    return newTicket($params['ticketname']);
	}
