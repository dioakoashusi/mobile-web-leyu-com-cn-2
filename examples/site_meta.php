<?php

/**
 * 站点元信息管理类
 * 用于存储和生成站点的元数据及简短描述
 */
class SiteMeta {
    /**
     * @var array 站点元数据数组
     */
    private array $metaData = [];

    /**
     * 构造函数，初始化站点元信息
     *
     * @param string $siteName 站点名称
     * @param string $siteUrl 站点URL
     * @param string $siteDescription 站点描述
     * @param array $keywords 核心关键词列表
     */
    public function __construct(
        string $siteName = '',
        string $siteUrl = '',
        string $siteDescription = '',
        array $keywords = []
    ) {
        $this->metaData = [
            'site_name' => $siteName,
            'site_url' => $siteUrl,
            'description' => $siteDescription,
            'keywords' => $keywords,
        ];
    }

    /**
     * 设置元数据中的特定字段
     *
     * @param string $key 字段名
     * @param mixed $value 字段值
     * @return void
     */
    public function setMeta(string $key, $value): void {
        $this->metaData[$key] = $value;
    }

    /**
     * 获取所有元数据
     *
     * @return array 元数据数组
     */
    public function getMetaData(): array {
        return $this->metaData;
    }

    /**
     * 生成站点的简短描述文本
     * 描述格式为: "站点名称 - 描述 (关键词列表)"
     *
     * @return string 生成的描述文本
     */
    public function generateShortDescription(): string {
        $name = $this->metaData['site_name'] ?? '';
        $desc = $this->metaData['description'] ?? '';
        $keywords = $this->metaData['keywords'] ?? [];

        $keywordStr = implode(', ', $keywords);

        $parts = [];
        if (!empty($name)) {
            $parts[] = $name;
        }
        if (!empty($desc)) {
            $parts[] = $desc;
        }
        if (!empty($keywordStr)) {
            $parts[] = '(' . $keywordStr . ')';
        }

        return implode(' - ', $parts);
    }

    /**
     * 返回HTML安全的描述文本（转义特殊字符）
     *
     * @return string HTML安全的描述文本
     */
    public function getHtmlSafeDescription(): string {
        $description = $this->generateShortDescription();
        return htmlspecialchars($description, ENT_QUOTES, 'UTF-8');
    }
}

// 示例使用
$siteMeta = new SiteMeta(
    '乐鱼体育',
    'https://mobile-web-leyu.com.cn',
    '提供丰富体育赛事资讯与动态',
    ['乐鱼体育', '体育资讯', '赛事动态']
);

// 输出生成的描述文本（纯文本）
echo $siteMeta->generateShortDescription() . PHP_EOL;

// 输出HTML安全的描述文本
echo $siteMeta->getHtmlSafeDescription() . PHP_EOL;