<?php namespace LaravelSeed;

use LaravelSeed\Exceptions\SeederException;

class SeederFactory {

    /**
     * Return an provider instance ..
     *
     * @param $alias
     * @return mixed
     * @throws SeederException
     */
    public static function factory($alias) {
        if(! is_array(config('seeds')))
            throw new SeederException('Not found configuration file. Please use vendor:publish to publish config file!');

        if(! in_array($alias, array_keys(config('seeds.providers'))))
            throw new SeederException('Invalid provider selected!');

        $config = config('seeds.providers.' . trim(strtolower($alias)));

        if( !isset($config['class']) )
            return $config;


        return new $config['class']($config);
    }

}