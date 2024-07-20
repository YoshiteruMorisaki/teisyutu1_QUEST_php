<?php 

class Deck {

    private array $deck = [];

    public function __construct()
    {
        $suits = ['スペード', 'ダイヤ', 'ハート', 'クラブ'];
        $ranks = [
            1 => '2',
            2 => '3',
            3 => '4',
            4 => '5',
            5 => '6',
            6 => '7',
            7 => '8',
            8 => '9',
            9 => '10',
            10 => 'J',
            11 => 'Q',
            12 => 'K',
            13 => 'A',
        ];

    // ランク含めた山札の作成
        foreach($suits as $suit){
            foreach($ranks as $rank => $number){
             
                $this->deck[] = [$suit, $rank, $number];
            }
        }
    }

    public function shuffleDeck():array {
        shuffle($this->deck);
        return $this->deck;
    }

    public function getDeck():mixed{
        return $this->deck;
    }

    public function setDeck($deck):void {
        $this->deck = $deck;
    }
}
