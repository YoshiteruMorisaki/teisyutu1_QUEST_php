<?php 

require_once 'Player.php';
require_once 'Deck.php';

class Game {

    private $players = [];

    public function BeforeStartGame() {

        $this->players = [
            new Player('プレイヤー1'),
            new Player('プレイヤー2'),
        ];

        echo "戦争を開始します。\n";

        $deck = new Deck();
        $deck->shuffleDeck();

        $this->players[0]->dealCard($deck, 26);
        $this->players[1]->dealCard($deck, 26);

        echo "カードが配られました。\n";

        return $this;

    }

    public function WarOfTrump() {

        // 手札(要素）がひとつ(一枚)以上あれば
        while($this->players[0]->issetHand() && $this->players[1]->issetHand()) {

            echo "戦争!\n";

            $P1_card = $this->players[0]->playCard();
            $P2_card = $this->players[1]->playCard();

            // 場に出されるカードの保管配列
            $setFieldCard = [];
            // それぞれ配列末尾に追加
            $setFieldCard[] = $P1_card;
            $setFieldCard[] = $P2_card;


            echo $this->players[0]->getPlayerName() . 'のカードは' . $P1_card[0] . 'の' . $P1_card[2] . "です。\n";
            echo $this->players[1]->getPlayerName() . 'のカードは' . $P2_card[0] . 'の' . $P2_card[2] . "です。\n";

             // ランクの比較 
             // while文の中で再度ループ開始
            while($P1_card[1] == $P2_card[1]) {

                echo "引き分けです。\n";

                if(!$this->players[0]->issetHand() || !$this->players[1]->issetHand()) {

                    echo "手札が無くなりました。戦争を終了します。\n";
                    break 2;
                }

                $P1_card = $this->players[0]->playCard();
                $P2_card = $this->players[1]->playCard();

                $setFieldCard[] = $P1_card;
                $setFieldCard[] = $P2_card;

                echo $this->players[0]->getPlayerName() . 'のカードは' . $P1_card[0] . 'の' . $P1_card[2] . "です。\n";
                echo $this->players[1]->getPlayerName() . 'のカードは' . $P2_card[0] . 'の' . $P2_card[2] . "です。\n";
                
            }
            // 勝者の手札更新
            if($P1_card[1] > $P2_card[1]){

                echo $this->players[0]->getPlayerName() . 'が勝ちました。' . $this->players[0]->getPlayerName() . 'の手札は' . $this->players[0]->winCard($setFieldCard) . "枚に増えました。\n";

            } else if($P1_card[1] < $P2_card[1]){

                echo $this->players[1]->getPlayerName() . 'が勝ちました。' . $this->players[1]->getPlayerName() . 'の手札は' . $this->players[1]->winCard($setFieldCard) . "枚に増えました。\n";

            }
            // 勝者の結果表示

            // プレイヤー1の勝利
            if(!$this->players[1]->issetHand()){

                echo $this->players[1]->getPlayerName() . "の手札が無くなりました。\n";
                echo $this->players[0]->getPlayerName() . 'の手札の枚数は52枚です。' . $this->players[1]->getPlayerName() . "の手札の枚数は0枚です。\n";
                echo $this->players[0]->getPlayerName() . 'が1位、' . $this->players[1]->getPlayerName() . "が2位です。\n";
                break;
            }
            // プレイヤー2の勝利
            if(!$this->players[0]->issetHand()){

                echo $this->players[0]->getPlayerName() . "の手札が無くなりました。\n";
                echo $this->players[1]->getPlayerName() . 'の手札の枚数は52枚です。' . $this->players[0]->getPlayerName() . "の手札の枚数は0枚です。\n";
                echo $this->players[1]->getPlayerName() . 'が1位、' . $this->players[0]->getPlayerName() . "が2位です。\n";
                break;
            }

        }
        echo "戦争を終了します。\n";
    }
}
