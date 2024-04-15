<?php

namespace Database\Seeders;

use App\ValuesObject\Constants\AdditionType;
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

	/*** @return void */
	public static function seedDelicacies(): void
	{
		ModelCreator::createProduct(ProductType::DELICACY, 'Печенюха', 1, 'Масляне печиво з смачними шоколадними крихтами');
		ModelCreator::createProduct(ProductType::DELICACY, 'Napoleon', 3.99, 'Найпопулярніший торт в світі, але смачніше');
		ModelCreator::createProduct(ProductType::DELICACY, 'Мармелад', 1, 'Вишневий, яблучний та будь-який інший)');
		ModelCreator::createProduct(ProductType::DELICACY, 'Круасан', 1, 'Французька кухня у нас в меню з найтоншим тістом');
		ModelCreator::createProduct(ProductType::DELICACY, 'Бізе', 1, 'Ідеальний десерт для тих, хто любить солодке, але стежить за фігурою.');
		ModelCreator::createProduct(ProductType::DELICACY, 'Морозиво', 1, 'Прохолодне морозиво ідеально підійде для початку дня');
	}

	/*** @return void */
	public static function seedAdditions(): void
	{
		ModelCreator::createAddition(AdditionType::OTHER, 'Горіхи', 1, 'Чудові на смак та їх багато');
		ModelCreator::createAddition(AdditionType::SYRUP, 'Сироп', 1, 'Вишневий, ірландський та багато інших на ваш смак');
		ModelCreator::createAddition(AdditionType::CHOCOLATE, 'Шоколад', 1, 'Найчастіше гіркий, що містить не менше 75% какао-бобів, він дозволяє глибоко відчути смак напою.');
		ModelCreator::createAddition(AdditionType::OTHER, 'Сухофрукти', 1, 'Інжир, фініки і курага відмінно доповнять всі фруктово-квіткові нотки свіжообсмажених сортів Танзанії.');
		ModelCreator::createAddition(AdditionType::OTHER, 'Зефір', 1, ' Їх м’який смак доповнить ніжні сорти арабіки, плюс таке частування легко можна подати до домашнього застілля.');
		ModelCreator::createAddition(AdditionType::OTHER, 'Макаруни', 1, 'Дуже добре підходять до американо і лате. Просто ідеальний сніданок або кава-брейк з нотками французького флеру!');
	}
}