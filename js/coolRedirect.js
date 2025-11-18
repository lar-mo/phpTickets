/**
 * Copyright (C) 2002, Codehouse.com. All rights reserved.
 * CodeHouse(TM) is a registered trademark.
 *
 * THIS SOURCE CODE MAY BE USED FREELY PROVIDED THAT
 * IT IS NOT MODIFIED OR DISTRIBUTED
 * 
 * This file: coolRedirect.js
 * Program Name: Cool Redirect
 * You can obtain this script at http://www.codehouse.com
 *
 * Written by: Ed Phillips (EID#2) of Codehouse.com
 *
 * Created: 11/01/2002
 *
 * Last Revision Date: 11/01/2002
 */


function coolRedirect(url, msg)
{
   var TARG_ID = "COOL_REDIRECT";
   var DEF_MSG = "Redirecting...";

   if( ! msg )
   {
      msg = DEF_MSG;
   }

   if( ! url )
   {
      throw new Error('You didn\'t include the "url" parameter');
   }


   var e = document.getElementById(TARG_ID);

   if( ! e )
   {
      throw new Error('"COOL_REDIRECT" element id not found');
   }

   var cTicks = parseInt(e.innerHTML);

   var timer = setInterval(function()
   {
      if( cTicks )
      {
         e.innerHTML = --cTicks;
      }
      else
      {
         clearInterval(timer);
         document.body.innerHTML = msg;
         location = url;	  
      }

   }, 1000);
}