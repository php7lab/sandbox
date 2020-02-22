<?php

namespace PhpLab\Sandbox\I18Next\Services;

use PhpLab\Core\Legacy\Yii\Helpers\FileHelper;
use PhpLab\Core\Libs\Store\StoreFile;
use PhpLab\Sandbox\I18Next\Interfaces\Services\TranslationServiceInterface;
use PhpLab\Sandbox\I18Next\Libs\Translator;

class TranslationService implements TranslationServiceInterface
{

    /** @var Translator[] $translators */
    private $translators = [];
    private $bundles = [];
    private $language;
    private $defaultLanguage;
    private $fallbackLanguage;

    public function __construct(array $bundles = [], string $defaultLanguage = 'en')
    {
        if($bundles) {
            $this->defaultLanguage = $defaultLanguage;
            $this->bundles = $bundles;
        } else {
            $store = new StoreFile($_ENV['I18NEXT_CONFIG_FILE']);
            $config = $store->load();
            $this->defaultLanguage = $config['defaultLanguage'] ?? $defaultLanguage;
            $this->bundles = $config['bundles'] ?? [];
        }
        $this->language = $this->defaultLanguage;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function setLanguage(string $language, string $fallback = null)
    {
        $language = explode('-', $language)[0];
        $this->language = $language;
        foreach ($this->translators as $translator) {
            $translator->setLanguage($language, $fallback);
        }
        if ($fallback) {
            $this->fallbackLanguage = $fallback;
        }
    }

    public function t(string $bundleName, string $key, array $variables = [])
    {
        $translator = $this->getTranslator($bundleName);
       // dd()
        return $translator->getTranslation($key, $variables);
    }

    private function getTranslator(string $bundleName): Translator
    {
        if ( ! isset($this->translators[$bundleName])) {
            $bundlePath = $this->bundles[$bundleName];
            $this->loadBundle($bundleName, $bundlePath);
        }
        return $this->translators[$bundleName];
    }

    private function loadBundle(string $bundleName, string $bundlePath)
    {
        $path = $this->forgePath($bundlePath);
        $i18n = new Translator($path, $this->language);
        $this->translators[$bundleName] = $i18n;
    }

    private function forgePath(string $bundlePath): string
    {
        $rootDir = FileHelper::rootPath();
        $fileMask = "$rootDir/$bundlePath";
        //dd();
        return $fileMask;
    }

}
