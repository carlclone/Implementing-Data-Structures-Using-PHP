<?php

class BinaryNode {

    public $data;
    public $left;
    public $right;

    public function __construct(string $data = NULL) {
        $this->data = $data;
        $this->left = NULL;
        $this->right = NULL;
    }


    public function addChildren(BinaryNode $left, BinaryNode $right) {
        $this->left = $left;
        $this->right = $right;
    }

}

class BinaryTree {

    public $root = NULL;

    public function __construct(BinaryNode $node) {
        $this->root = $node;
    }

    public function isEmpty(): bool {
        return $this->root === NULL;
    }

    public function traverse(BinaryNode $node, int $level = 0) {


        /*
         * 树遍历顺序的特点
         * 中序遍历是最常用的方法(用于表示数学表达式https://www.cnblogs.com/lxrm/p/6443984.html), 前序遍历和后序遍历不常用，但是在解析数学表达式的时候经常被用到
         * 二叉搜索树的中序遍历 -> 可以使得树中的节点按照关键字值升序的顺序依次被访问到
         * http://blog.csdn.net/prince_jun/article/details/7699024
         * */

        //中左右 遍历顺序 特点 :
        if ($node) {
            echo str_repeat("-", $level);
            echo $node->data . "\n";


            if ($node->left)
                $this->traverse($node->left, $level + 1);

            if ($node->right)
                $this->traverse($node->right, $level + 1);
        }
    }

}

try {

    $final = new BinaryNode("Final");

    $tree = new BinaryTree($final);

    $semiFinal1 = new BinaryNode("Semi Final 1");
    $semiFinal2 = new BinaryNode("Semi Final 2");
    $quarterFinal1 = new BinaryNode("Quarter Final 1");
    $quarterFinal2 = new BinaryNode("Quarter Final 2");
    $quarterFinal3 = new BinaryNode("Quarter Final 3");
    $quarterFinal4 = new BinaryNode("Quarter Final 4");

    $semiFinal1->addChildren($quarterFinal1, $quarterFinal2);
    $semiFinal2->addChildren($quarterFinal3, $quarterFinal4);

    $final->addChildren($semiFinal1, $semiFinal2);

    $tree->traverse($tree->root);
} catch (Exception $e) {
    echo $e->getMessage();
}