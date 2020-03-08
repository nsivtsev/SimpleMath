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

use nsivtsev\SimpleMathBundle\Util\Math;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function index()
    {
        $math = new Math();
        dump($math->solve('(2+2)*2'));
    }
}
  ```
  
  Автор: Николай Сивцев
  
  Если есть замечания, буду рад получить в [Issues](https://github.com/nsivtsev/SimpleMath/issues) либо в [Telegram](https://teleg.run/favorit_ykt)
