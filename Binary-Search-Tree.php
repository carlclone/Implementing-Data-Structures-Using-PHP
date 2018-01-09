<?php

class Node
{

    /**
     * @var int
     */
    public $data;
    /**
     * @var null
     */
    public $left;
    /**
     * @var null
     */
    public $right;

    /**
     * Node constructor.
     * @param int|NULL $data
     */
    public function __construct(int $data = NULL)
    {
        $this->data = $data;
        $this->left = NULL;
        $this->right = NULL;
    }

    // 二叉搜索树, 最左边的最小,最右边的最大

    /**
     * @return Node|null
     */
    public function min()
    {
        $node = $this;

        while ($node->left) {
            $node = $node->left;
        }

        return $node;
    }

    /**
     * @return Node|null
     */
    public function max()
    {
        $node = $this;

        while ($node->right) {
            $node = $node->right;
        }

        return $node;
    }

    //寻找节点的右节点的最左边的值(最小值)

    /**
     * @return null
     */
    public function successor()
    {

        $node = $this;
        if ($node->right)
            return $node->right->min();
        else
            return NULL;
    }

    //寻找节点的左节点的最右边的值(最大值)

    /**
     * @return null
     */
    public function predecessor()
    {
        $node = $this;
        if ($node->left)
            return $node->left->max();
        else
            return NULL;
    }

}

class BST
{

    /**
     * @var Node|null
     */
    public $root = NULL;

    /**
     * BST constructor.
     * @param int $data
     */
    public function __construct(int $data)
    {
        $this->root = new Node($data);
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->root === NULL;
    }


    /**
     * 思路:从根节点开始,比节点大进入右边,比节点小进入左边,然后继续比较直到找到一个相等的 (分治思想)
     * @param int $data
     * @return bool|Node|null
     */
    public function search(int $data)
    {
        if ($this->isEmpty()) {
            return FALSE;
        }

        $node = $this->root;


        while ($node) {
            if ($data > $node->data) {
                $node = $node->right;
            } elseif ($data < $node->data) {
                $node = $node->left;
            } else {
                break;
            }
        }


        return $node;
    }


    /**
     * 思路:
     * 情况: 没有在中间插入的情况 , 只有在底部插入
     *
     *
     * @param int $data
     * @return Node|null
     */
    public function insert(int $data)
    {

        if ($this->isEmpty()) {
            $node = new Node($data);
            $this->root = $node;
            return $node;
        }

        $node = $this->root;

        while ($node) {

            if ($data > $node->data) {

                if ($node->right) {
                    $node = $node->right;
                } else {
                    $node->right = new Node($data);
                    $node = $node->right;
                    break;
                }

            } elseif ($data < $node->data) {
                if ($node->left) {
                    $node = $node->left;
                } else {
                    $node->left = new Node($data);
                    $node = $node->left;
                    break;
                }
            } else {
                break;
            }

        }

        return $node;


    }

    /**
     * 中序遍历,有序数列
     * 思路: 分解为小问题(最小的二叉搜索树),递归解决,左中右的顺序显示
     * 情况:
     * @param Node $node
     */
    public function traverse(Node $node)
    {
        if ($node) {
            if ($node->left)
                $this->traverse($node->left);

            echo $node->data . "\n";

            if ($node->right)
                $this->traverse($node->right);
        }
    }

}

try {


    $tree = new BST(10);

    $tree->insert(12);
    $tree->insert(6);
    $tree->insert(3);
    $tree->insert(8);
    $tree->insert(15);
    $tree->insert(13);
    $tree->insert(36);


    echo $tree->search(14) ? "Found" : "Not Found";
    echo "\n";
    echo $tree->search(36) ? "Found" : "Not Found";

    $tree->traverse($tree->root);

    echo $tree->root->predecessor()->data;

} catch (Exception $e) {
    echo $e->getMessage();
}