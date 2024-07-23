<?php 

require_once 'Deck.php';

class Player {

    private string $playerName;
    private array $hand = [];

    public function __construct(string $playerName)
    {
        $this->playerName = $playerName;
    }
    
    public function dealCard(Deck $deck, $numberSheets):mixed {
        //山札の用意
        $preparedDeck = $deck->getDeck();
        //プレイヤーに配る枚数分のカード分け(array_sliceはデフォルトで配列の数値キー並べなおし)
        $dealCard = array_slice($preparedDeck, 0, $numberSheets);
        // 山札の枚数更新
        array_splice($preparedDeck, 0, $numberSheets);
        $deck->setDeck($preparedDeck);
        $this->hand = $dealCard;
        return $this->hand;
    }

    public function getHand():array {
        return $this->hand;
    }

    public function shuffleHand():array {
        shuffle($this->hand);
        return $this->hand;
    }

    public function playCard():array {

        // 常にシャッフルすることで先頭を更新し続ける
        return array_shift($this->hand);
    }

    public function winCard(array $card):int {
        // 場にあるカードを手札のカードの配列に追加
        $this->hand = array_merge($this->hand, $card);
        return count($this->hand);
    }

    public function issetHand():bool {
        return count($this->hand) > 0;
    }

    public function getPlayerName():string {
        return $this->playerName;
    }
}

