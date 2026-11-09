<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $foods = [
    // 0：少量產氣（EAT）
    ['food_name' => '櫛瓜',       'gas_label' => 0],
    ['food_name' => '紅蘿蔔',     'gas_label' => 0],
    ['food_name' => '羽衣甘藍',   'gas_label' => 0],
    ['food_name' => '南瓜',       'gas_label' => 0],
    ['food_name' => '番茄',       'gas_label' => 0],
    ['food_name' => '甜椒',       'gas_label' => 0],
    ['food_name' => '茄子',       'gas_label' => 0],
    ['food_name' => '藍莓',       'gas_label' => 0],
    ['food_name' => '草莓',       'gas_label' => 0],
    ['food_name' => '鳳梨',       'gas_label' => 0],
    ['food_name' => '柳橙',       'gas_label' => 0],
    ['food_name' => '奇異果',     'gas_label' => 0],
    ['food_name' => '葡萄',       'gas_label' => 0],
    ['food_name' => '木瓜',       'gas_label' => 0],
    ['food_name' => '藜麥',       'gas_label' => 0],
    ['food_name' => '燕麥',       'gas_label' => 0],
    ['food_name' => '蕎麥',       'gas_label' => 0],
    ['food_name' => '雞胸肉',     'gas_label' => 0],
    ['food_name' => '瘦牛肉',     'gas_label' => 0],
    ['food_name' => '板豆腐',     'gas_label' => 0],
    ['food_name' => '鮭魚',       'gas_label' => 0],
    ['food_name' => '白肉魚',     'gas_label' => 0],
    ['food_name' => '蝦',         'gas_label' => 0],

    // 1：中量產氣（LIMIT）
    ['food_name' => '地瓜',       'gas_label' => 1],
    ['food_name' => '甜菜根',     'gas_label' => 1],
    ['food_name' => '四季豆',     'gas_label' => 1],
    ['food_name' => '青花菜',     'gas_label' => 1],
    ['food_name' => '白花椰菜',   'gas_label' => 1],
    ['food_name' => '酪梨',       'gas_label' => 1],
    ['food_name' => '覆盆莓',     'gas_label' => 1],
    ['food_name' => '去皮蘋果',   'gas_label' => 1],
    ['food_name' => '去皮梨子',   'gas_label' => 1],
    ['food_name' => '全麥麵包',   'gas_label' => 1],
    ['food_name' => '大麥',       'gas_label' => 1],
    ['food_name' => '熟扁豆',     'gas_label' => 1],
    ['food_name' => '熟鷹嘴豆',   'gas_label' => 1],
    ['food_name' => '腰果',       'gas_label' => 1],
    ['food_name' => '花生',       'gas_label' => 1],
    ['food_name' => '豆漿',       'gas_label' => 1],
    ['food_name' => '無乳糖牛奶', 'gas_label' => 1],

    // 2：多量產氣（AVOID）
    ['food_name' => '洋蔥',       'gas_label' => 2],
    ['food_name' => '大蒜',       'gas_label' => 2],
    ['food_name' => '韭蔥',       'gas_label' => 2],
    ['food_name' => '紅蔥頭',     'gas_label' => 2],
    ['food_name' => '蘑菇',       'gas_label' => 2],
    ['food_name' => '蘆筍',       'gas_label' => 2],
    ['food_name' => '朝鮮薊',     'gas_label' => 2],
    ['food_name' => '生高麗菜',   'gas_label' => 2],
    ['food_name' => '黃豆',       'gas_label' => 2],
    ['food_name' => '黑豆',       'gas_label' => 2],
    ['food_name' => '豌豆仁',     'gas_label' => 2],
    ['food_name' => '牛奶',       'gas_label' => 2],
    ['food_name' => '冰淇淋',     'gas_label' => 2],
    ['food_name' => '白吐司',     'gas_label' => 2],
    ['food_name' => '義大利麵',   'gas_label' => 2],
    ['food_name' => '西瓜',       'gas_label' => 2],
    ['food_name' => '櫻桃',       'gas_label' => 2],
    ['food_name' => '帶皮蘋果',   'gas_label' => 2],
    ['food_name' => '椰棗',       'gas_label' => 2],
    ['food_name' => '無花果',     'gas_label' => 2],
];
foreach ($foods as $food) {
        DB::table('food')->updateOrInsert(
            ['food_name' => $food['food_name']],
            ['gas_label' => $food['gas_label'], 'updated_at' => now()]
        );
    }
    }
}
