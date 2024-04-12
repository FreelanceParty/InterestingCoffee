<?php

namespace Database\Seeders;

use App\ValuesObject\Constants\ProductType;
use App\ValuesObject\ModelCreator;

/**
 * Class CustomSeeder
 * @package Database\Seeders
 */
class CustomSeeder
{
	/*** @return void */
	public static function seedCoffees(): void
	{
		ModelCreator::createProduct(ProductType::COFFEE, 'Café con Leche', 1, 'Португальська або іспанська темна кава з додаванням цукру і молока');
		ModelCreator::createProduct(ProductType::COFFEE, 'Demi-crème', 1, 'Кава з вершками або молоком у рівних пропорціях');
		ModelCreator::createProduct(ProductType::COFFEE, 'Granita de Caffe', 1, 'Холодний еспресо, подається з льодом');
		ModelCreator::createProduct(ProductType::COFFEE, 'Айріш', 1, 'Кава з алкоголем і з збитими густими вершками. Подається у спеціальних айріш - келихах');
		ModelCreator::createProduct(ProductType::COFFEE, 'Амерікано', 1, 'Кава еспресо, розведена водою. Американо готується на еспресо-кавоварки: бариста після приготування 30 мл еспрессо не вимикає кавоварку, а продовжує пропускати воду до отримання обсягу 120-160 мл');
		ModelCreator::createProduct(ProductType::COFFEE, 'Глясе', 1, 'Прохолодна кава з кулькою морозива. Подається в айріш - келиху з трубочкою');
	}
}