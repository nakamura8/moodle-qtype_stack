# 問題作成クイック・スタート・ガイド 6: STACK問題ライブラリ

[1 - 動作する最小限の問題](Authoring_quick_start_1.md) | [2 - 問題変数](Authoring_quick_start_2.md) | [3 - フィードバックを改善する](Authoring_quick_start_3.md) | [4 - ランダム化](Authoring_quick_start_4.md) | [5 - 問題のテスト](Authoring_quick_start_5.md) | 6 - STACK問題ライブラリ | [7 - 複数解答欄問題](Authoring_quick_start_7.md) | [8 - 数式簡略の無効化](Authoring_quick_start_8.md) | [9 - 小テストの設定](Authoring_quick_start_9.md)

問題作成クイック・スタート・ガイドのこのパートでは,問題のインポートと小テストについて扱います。次のビデオでそのやり方を説明します：

<iframe width="560" height="315" src="https://www.youtube.com/embed/P3bDdNVC6g0" frameborder="0" allowfullscreen></iframe>

### はじめに

問題を作成したら,小テストに組み込みたくなるでしょう。サンプル問題を使用して小テストを作成することもできます。

このドキュメントは,初心者がSTACKを使用して,Moodleの小テストで数学の問題の作成する方法について説明します。このガイドはMoodle小テストのドキュメントと一部重複します。

これらはDr Maureen McIver, Department of Mathematical Sciences, Loughborough University, UK, July 2016が作成したメモを編集したものです。

### 問題の選択

小テストに使う問題を選ぶことから始めましょう。すでに作られている問題を編集して,目的に合うように修正することが一番簡単な方法です。

これまでの問題作成クイックスタートガイドに従って,ゼロから独自の問題を作っても良いでしょう。

### 既存のサーバから問題をインポートする

既存のサーバから問題をインポートする方法を確認しましょう。

まず,既存の問題をエクスポートする必要があります：

1. エクスポートしたい問題があるMoodlにログインし,管理ブロックの`問題バンク`をクリックしてください。次に`エクスポート`をクリックしてください。
2. `Moodle XMLフォーマット`をクリックし,エクスポートしたいカテゴリを選択します。Moodleでは個々のカテゴリのみエクスポートすることができます。
3. `問題をファイルにエクスポートする`をクリックしてください。これにより,そのカテゴリのすべての問題を含むファイルがダウンロードされます。

これらの問題をあなたのサーバにインポートします：

1. Moodleサーバであなたのコースにログインし,管理ブロックの問題バンクをクリックします。
2. `インポート`をクリックしてください。
3. `Moodle XMLフォーマット`をクリックし,あなたのインポートしたい?.xmlファイルをドラッグ＆ドロップし,`インポート`および`続行`をクリックします。問題のコピーがあなたのコースの問題バンクに表示され,自由に問題を変更することができます。

### gitsync module




# 次のステップ

##### 問題作成クイック・スタート・ガイドの次のパートでは，[複数解答欄問題](Authoring_quick_start_7.md)の使用について説明します

- [より多くの入力タイプについて学ぶ](../../en/Authoring/Inputs.md),
- [より多くの解答テストについて学ぶ](../../en/Authoring/Answer_Tests/index.md),
- [CASTextフィールド](../../en/Authoring/CASText.md)に[プロット](../../en/Plots/Plots.md)  を追加する
- [複数言語のサポートを追加する](../../en/Authoring/Languages.md),
- [等価推論の使用について学ぶ](../../en/Authoring/Equivalence_reasoning.md),
- [曲線スケッチについて読む](../../en/Topics/Curve_sketching.md).
- Maxima の構文や関数名にあまり詳しくない場合は,Maxima のドキュメントを参照してください。[wxMaxima](http://andrejv.github.com/wxmaxima/) のようなグラフィカルな Maxima インターフェースも,適切な Maxima コマンドを簡単に見つけるのに非常に役立ちます。