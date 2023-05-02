<?php

/**
 * Lasalle Software's Serverless package to render Laravel Framework blade templates
 * without launching an entire Laravel Application. For specific use in AWS Lambda.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright  (c) 2021 - 2023 The South LaSalle Trading Corporation
 * @license    http://opensource.org/licenses/MIT
 * @author     Bob Bloom
 * @email      bob.bloom@lasallesoftware.ca
 * @link       https://lasallesoftware.ca
 * @link       https://phpserverlessproject.com
 * @link       https://packagist.org/packages/lasallesoftwareserverless/render-blade-lambda
 * @link       https://github.com/lasallesoftware-serverless/render-blade-lambda
 *
 */

namespace Lasallesoftwareserverless\Renderbladelamdba;

use Illuminate\Container\Container;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\EngineResolver;

class View extends Container
{
    /**
     * Make the ViewFactory object. 
     * 
     * The purpose is to render a Laravel Framework Blade template in AWS Lambda
     *
     * @param  array   $pathToTemplate                 Blade template path. Yes, it is an array.
     * @param  string  $pathToCompiledBladeTemplate    Compile Blade template's local path.   
     * @return Illuminate\View\Factory
     */
    public function makeViewFactory($pathToTemplate, $pathToCompiledBladeTemplate) : object
    {
        // Determine if use the local path or the Lambda path, for the compiled Blade tempate
        $pathToCompiledTemplate = $this->getPathToCompiledTemplates($pathToCompiledBladeTemplate);

        $container = Container::getInstance();
        
        // Bind the app class to the interface, because the blade compiler 
        // needs the `getNamespace()` method to guess Blade component FQCNs
        $container->instance(Application::class, $container);

        // Dependencies
        $filesystem = new Filesystem;
        $eventDispatcher = new Dispatcher($container);

        // Create the View Factory capable of rendering PHP and Blade templates
        $viewResolver = new EngineResolver;
        $bladeCompiler = new BladeCompiler($filesystem, $pathToCompiledTemplate);
        $viewResolver->register('blade', function () use ($bladeCompiler) {
            return new CompilerEngine($bladeCompiler);
        });
        $viewFinder = new FileViewFinder($filesystem, $pathToTemplate);
        $viewFactory = new Factory($viewResolver, $viewFinder, $eventDispatcher);

        return $viewFactory;
    }

    /**
     * Get the path to the compiled Blade template
     *
     * @param   string  $path    The local path of the compiled Blade template
     * @return  string
     */
    private function getPathToCompiledTemplates($path) : string
    {
        // For Lambda, store the compiled views in `/tmp` because `/tmp` is the only writable directory on Lambda.
        // Note that compiled Blade templates are generated at runtime.
        // https://docs.aws.amazon.com/lambda/latest/dg/configuration-envvars.html

        if (isset($_SERVER['LAMBDA_TASK_ROOT'])) {
            return '/tmp';
        }

        return $path;
    }
}