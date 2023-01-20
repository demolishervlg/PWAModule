<?php

namespace ClickON\PWA\ManifestCollectors;

interface IManifestCollector {
    public function collect(): array;
}