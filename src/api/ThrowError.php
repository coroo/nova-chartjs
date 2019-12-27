<?php

namespace Coroowicaksono\ChartJsIntegration\Api;

use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ThrowError extends \Exception implements HttpExceptionInterface 
{
    
    public function getStatusCode()
   {
       return 500;
   }

   /**
    * Returns response headers.
    *
    * @return array Response headers
    */
   public function getHeaders()
   {
       return [];
   }
}