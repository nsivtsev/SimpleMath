# SimpleMath

Библиотека для вычисления из строки string, использует алгоритм преобразования и вычисления из инфиксной записи в постфиксную (обратная Польская запись)

### Требования:
- Symfony 4.4

### Установка:
 1. Добавить в composer.json: 
  ```json
  "repositories": [
      {
          "type": "vcs",
          "url": "https://github.com/nsivtsev/SimpleMath"
      }
  ]
  ```
  2. 
  ```
  composer require nsivtsev/simple-math:@dev
  ```
  
### Пример использования
  ```php
  <?php
namespace App\Controller;

use nsivtsev\SimpleMathBundle\Services\Math;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function index(Math $math)
    {
        dump($math->solve('(2+2)*2'));
    }
}
  ```
  
  ### UPD
  Исправления:
- Бандл зарегистрирован как сервис, autowiring, можно использовать DI
- Алгоритм вычисления заменен на "алгоритм сортировочной станции" (Shunting-yard algorithm) На основе исходников: https://gist.github.com/dremie/fcb1f5beecc327679de8cca51c8e4743
- Дописаны тесты
  
  Автор: Николай Сивцев
  
  Если есть замечания, буду рад получить в [Issues](https://github.com/nsivtsev/SimpleMath/issues) либо в [Telegram](https://teleg.run/favorit_ykt)
