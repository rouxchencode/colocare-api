# ColoCare 食材查詢 API

以 Laravel 建立的 REST API：輸入關鍵字查詢食材，回傳營養資料，並為每一筆食材標示紅黃綠燈。

本專案源自課程專題「ColoCare 大腸癌術後階梯式飲食管理系統」，這個儲存庫只實作其中的食材查詢端點，作為後端作品集練習。

## 免責聲明

這是教學與作品集專案，**不是醫療建議**。範例資料為示範用的假資料，燈號規則為自行設定的簡化示範，不可作為飲食或醫療決策依據。

## 使用技術

- PHP 8、Laravel
- MySQL（開發環境：XAMPP）

## 安裝與執行

```bash
git clone https://github.com/rouxchencode/colocare-api.git
cd colocare-api
composer install
cp .env.example .env
```

編輯 `.env`，填入資料庫設定（資料庫名稱 `colocare`，需先在 MySQL 建立）：

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=colocare
DB_USERNAME=root
DB_PASSWORD=
```

接著執行：

```bash
php artisan key:generate
php artisan migrate
php artisan serve
```

API 預設網址：`http://127.0.0.1:8000`

## API

### GET /api/foods

查詢食材，可用關鍵字篩選。

| 參數 | 必填 | 說明 |
|------|------|------|
| keyword | 否 | 食材名稱包含的文字；不帶則回傳全部 |

範例：

```
GET /api/foods?keyword=飯
```

回傳（JSON 陣列，每筆為一項食材，範例僅示意格式）：

```json
[
  {
    "id": 4,
    "food_name": "稀飯",
    "crude_fiber": "0.10",
    "fat_ratio": "0.10",
    "gas_label": 0,
    "created_at": null,
    "updated_at": null,
    "light": "green"
  }
]
```

沒有符合的資料時回傳空陣列 `[]`。

### 燈號規則（教學示範）

| 條件 | 燈號 |
|------|------|
| 易產氣（`gas_label` 為 1） | red |
| 粗纖維 > 2 或脂肪比率 > 10 | yellow |
| 其他 | green |

燈號在 API 回傳時即時計算，不存在資料庫中。

## 資料表

資料表名稱為 `food`（Laravel 依 Model 名稱 `Food` 自動推得，採用框架預設命名）。

| 欄位 | 型態 | 說明 |
|------|------|------|
| id | bigint | 主鍵 |
| food_name | varchar(100) | 食材名稱 |
| crude_fiber | decimal(5,2) | 粗纖維（g / 100g） |
| fat_ratio | decimal(5,2) | 脂肪比率（%） |
| gas_label | boolean | 是否為易產氣食材，預設 false |
| created_at / updated_at | timestamp | 建立與更新時間 |

資料表結構以 migration 管理，執行 `php artisan migrate` 即可建立。

## 未來規劃

- 匯入衛福部食品營養成分開放資料，取代示範資料
- 查詢結果加入分頁
- 新增食材端點與認證（Laravel Sanctum）
- 依術後階段（phase）調整燈號規則

## 作者

Roux
