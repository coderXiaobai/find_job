'''
72 编辑距离
给定两个单词 word1 和 word2，计算出将 word1 转换成 word2 所使用的最少操作数 。

你可以对一个单词进行如下三种操作：

插入一个字符
删除一个字符
替换一个字符
'''
def minDistance(word1, word2):
    """
    :type word1: str
    :type word2: str
    :rtype: int
    """
    #动态规划解法，没有做空间优化，记录了整张表,优化可以得到空间复杂度为O(min(m,n))
    m, n = len(word1), len(word2)
    if m == 0 or n == 0:
        return max(m, n)
    dp = [[0] * n for i in range(m)]
    #初始化第一行和第一列的值
    for i in range(n):
        dp[0][i] = i if word1[0] in word2[:i + 1] else i + 1
    for i in range(m):
        dp[i][0] = i if word2[0] in word1[:i + 1] else i + 1
    for i in range(1, m):
        for j in range(1, n):
            #如果word1[i] == word2[j]，那么说明只需将将word1[:i]变换到word2[:j]即可
            if word1[i] == word2[j]:
                dp[i][j] = dp[i - 1][j - 1]
            #否则，
            # 1 在word1[:i]变换到word2[:j - 1]后，再删除word1尾端的字符
            # 2 在word1[:i - 1]变换到word2[:j]后，再添加一个字符word1[i]到word1尾端
            # 3 直接在word1[:i - 1]变换到word2[:j - 1]后，添加一个字符word2[j]到word1尾
            # 即可完成变换，找到三种变换代价最小的即可
            else:
                dp[i][j] = min([dp[i - 1][j] + 1, dp[i][j - 1] + 1, dp[i - 1][j - 1] + 1])
    return dp[-1][-1]