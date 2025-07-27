<?php

namespace DevNoKage;

use DevNoKage\Enums\ClassName;
use Symfony\Component\Yaml\Yaml;

class App
{
    private static array $dependencies;
    private static array $container = []; 

    public static function getDependencie(ClassName $className): mixed
    {
        if (!isset(self::$dependencies)) {
            self::$dependencies = Yaml::parseFile(SERVICES_PATH);
        }

        if (!array_key_exists($className->value, self::$dependencies)) {
            throw new \Exception("La dépendance '{$className->value}' est introuvable dans services.yml.");
        }

        $definition = self::$dependencies[$className->value];
        $classNameStr = $definition['class'] ?? null;
        $arguments = $definition['argument'] ?? [];
        $isSingleton = $definition['singleton'] ?? false;

        if (!$classNameStr || !class_exists($classNameStr)) {
            throw new \Exception("La classe '{$classNameStr}' n'existe pas pour le service '{$className->value}'.");
        }

        if ($isSingleton && isset(self::$container[$className->value])) {
            return self::$container[$className->value];
        }

        try {
            $resolvedArgs = [];

            foreach ($arguments as $arg) {
                if (is_string($arg)) {
                    if (str_starts_with($arg, '@')) {
                        $depKey = ltrim($arg, '@');
                        $depClassName = ClassName::from($depKey);
                        $resolvedArgs[] = self::getDependencie($depClassName);
                    } elseif (preg_match('/^%(.+)%$/', $arg, $matches)) {
                        $constName = $matches[1];
                        if (defined($constName)) {
                            $resolvedArgs[] = constant($constName);
                        } else {
                            throw new \Exception("La constante {$constName} n'est pas définie.");
                        }
                    } else {
                        $resolvedArgs[] = $arg;
                    }
                } else {
                    $resolvedArgs[] = $arg;
                }
            }

            $reflector = new \ReflectionClass($classNameStr);
            $instance = $reflector->newInstanceArgs($resolvedArgs);

            if ($isSingleton) {
                self::$container[$className->value] = $instance;
            }

            return $instance;
        } catch (\ReflectionException $e) {
            throw new \Exception("Erreur lors de l’instanciation de '{$classNameStr}' : " . $e->getMessage());
        }
    }
}
