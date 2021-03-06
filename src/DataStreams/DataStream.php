<?php

/*
 *	Copyright 2015 RhubarbPHP
 *
 *  Licensed under the Apache License, Version 2.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 *  Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License.
 */


namespace Rhubarb\Crown\DataStreams;

/**
 * An abstract base class to model data streams.
 */
abstract class DataStream
{
    public function __construct()
    {
    }

    public function readNextItem()
    {
        return false;
    }

    public function appendItem($item)
    {

    }

    public final function pushAllItems(DataStream $targetStream)
    {
        while ($item = $this->readNextItem()) {
            $targetStream->appendItem($item);
        }
    }
}