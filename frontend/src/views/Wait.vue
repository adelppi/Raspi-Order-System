<template>
    <h1>届くまで<br>待ってね<br>😋</h1>
    <div class="ad">
        <h2><budoux-ja>お持ち帰りのお菓子も販売中！</budoux-ja></h2>
        <img src="/src/assets/cookie.jpg">
        <p>
            <budoux-ja>
                紅茶やコーヒーのお供に甘いお菓子はいかがですか？
                軽い"ふわしゅわ"食感のメレンゲクッキー・サクサククッキー、レジにて販売中！！
            </budoux-ja>
            <br><br>
        <p class="note">
            <budoux-ja>メレンゲクッキーには卵、クッキーには卵/バター(乳成分を含む)を使用しています。</budoux-ja>
        </p>
        </p>
    </div>
</template>

<style scoped>

h1 {
    font-size: 2.5rem;
}

img {
    width: 75%;
    margin: 0 auto;
}

p {
    margin: 0 auto;
    width: 75%;
}

.ad {
    width: 100%;
    display: flex;
    margin: 0 auto;
    justify-content: center;
    flex-direction: column;
    background-color: rgb(255, 246, 235);

}

.note {
    background-color: yellow;
}
</style>