<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function places()
    {
        return $this->hasMany(Place::class, 'user_id'); // ✅ User は複数の Place を持つ
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $user->places()->create([
                'user_id' => $user->id,
                'category_id' => NULL,
                'title' => 'Markdown完全マスターガイド',
                'body' => "# Markdown完全マスターガイド

Markdown（マークダウン）は、シンプルな記法で文書を装飾できる軽量マークアップ言語です。  
特定の記号を使って、見出しやリスト、強調などを簡単に表現できます。

## Markdownとは

Markdownは、2004年にJohn Gruberによって開発された、プレーンテキスト形式で書かれた文書を、  
簡単にHTMLなどのリッチテキストに変換するための記法です。  
そのシンプルさと可読性の高さから、ブログ記事、技術文書、メモなど幅広い用途で利用されています。

---

## 基本の書式

### 見出し

見出しは、行頭に`#`を付けることで作成できます。「`#`」の数を増やすことで、見出しのレベルを変更できます。

# 見出し1 ・・・`# 見出し1`
## 見出し2・・・`## 見出し2`
### 見出し3・・・`### 見出し3`
#### 見出し4・・・`#### 見出し4`
##### 見出し5・・・`##### 見出し5`
###### 見出し6・・・`###### 見出し6`

### 段落

Markdownでは、文章の間に空行を入れることで段落を分けることができます。

### 強調

テキストの強調には、以下の記法を使用します。

- *斜体*：`*斜体*` または `_斜体_`
- **太字**：`**太字**` または `__太字__`
- ***斜体と太字***：`***斜体と太字***` または `___斜体と太字___`

---

## リスト

### 番号なしリスト

`-`、`*`、`+` のいずれかを使用してリストを作成できます。

### 番号付きリスト

数字とドットを組み合わせることで、順序付きリストを作成できます。

---

## リンクと画像

### リンク

`[リンクテキスト](URL)`の形式で記述します。

### 画像

`![Altテキスト](画像URL)` の形式で画像を埋め込みます。

---

## コード

### インラインコード

バッククォート `` ` `` で囲むことで、インラインコードを記述できます。

### コードブロック

バッククォート3つで囲むことで、複数行のコードブロックを作成できます。

---

## 引用

引用は、行頭に`>`を付けることで作成します。

---

## テーブル

`|`を使って、表を作成できます。

---

## チェックボックス

`- [ ]` または `- [x]` でチェックリストを作成できます。

---

## 詳細の開閉

HTMLの`<details>`タグを使用して、折りたたみ可能な詳細を作成できます。

---

## 特殊文字

HTMLエンティティを使用することで、特殊文字を記述できます。

---

## エスケープ

Markdownの特殊文字をエスケープするには、バックスラッシュ `\` を使用します。

---

このガイドを活用して、Markdownの記法を使いこなしましょう！ 🎉",
                'study_date' => now()->toDateString(),
                'study_time' => now()->format('H:i:s'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
