"""
97 交错字符串

给定三个字符串 s1, s2, s3, 验证 s3 是否是由 s1 和 s2 交错组成的。

示例 1:

输入: s1 = "aabcc", s2 = "dbbca", s3 = "aadbbcbcac"
输出: true
示例 2:

输入: s1 = "aabcc", s2 = "dbbca", s3 = "aadbbbaccc"
输出: false
"""
#dp解法，在s1和s2之前添加一个空字符串'',dp[i][j]代表s1(0...i - 1)和s2(0...j - 1)能否交替组成s3(0...i + j - 1)
def test(s1,s2,s3):
    len1,len2,len3 =len(s1),len(s2),len(s3)
    if len1 + len2 != len3:
        return False
    #未进行空间优化，直接生成(len1 + 1) * (len2 + 1)的dp矩阵
    dp = [[False] * (len2 + 1) for i in range(len1 + 1)]
    dp[0][0] = True
    #初始化边界
    for i in range(1,len1 + 1):
        if s1[i - 1] == s3[i - 1] and dp[i - 1][0]:
            dp[i][0] = True
        else:
            dp[i][0] = False
    for i in range(1,len2 + 1):
        if s2[i - 1] == s3[i - 1] and dp[0][i - 1]:
            dp[0][i] = True
        else:
            dp[0][i] = False
    for i in range(1,len1 + 1):
        for j in range(1,len2 + 1):
            #如果s1(0...i - 2)和s2(0...j - 1)能交替组成s3(0...i + j - 2)，且s1[i - 1] == s3[i + j - 1]，
            # 那么说明s1(0...i - 1)和s2(0...j - 1)能交替组成s3(0...i + j - 1)
            if dp[i - 1][j] and s1[i - 1] == s3[i + j - 1]:
                dp[i][j] = True
            #同理
            elif dp[i][j - 1] and s2[j - 1] == s3[i + j - 1]:
                dp[i][j] = True
            #否则无法交替组成
            else:
                dp[i][j] = False
    return dp[-1][-1]


#空间优化版，空间复杂度为O(min(len1,len2) + 1)
def test(s1,s2,s3):
    len1,len2,len3 =len(s1),len(s2),len(s3)
    #短的字符串做原来dp的s2
    if len1 < len2:
        s1,s2 = s2,s1
        len1, len2 = len(s1), len(s2)
    if len1 + len2 != len3:
        return False
    #仅生成一个较短字符串长度的一维数组
    dp = [False] * (len2 + 1)
    dp[0] = True
    #初始化dp
    for i in range(1,len2 + 1):
        if s2[i - 1] == s3[i - 1] and dp[i - 1]:
            dp[i] = True
        else:
            dp[i] = False
    for i in range(1,len1 + 1):
        for j in range(len2 + 1):
            #如果是原来dp中某一行的第一列，那么只用和dp[i - 1][j]的值比较，其实就是现在的dp[j]
            if j == 0:
                if dp[j] and s1[i - 1] == s3[i + j - 1]:
                    dp[j] = True
                else:
                    dp[j] = False
            else:
                #如果s1(0...i - 2)和s2(0...j - 1)能交替组成s3(0...i + j - 2)，且s1[i - 1] == s3[i + j - 1]，
                # 那么说明s1(0...i - 1)和s2(0...j - 1)能交替组成s3(0...i + j - 1)
                # 这里原先是和dp[i - 1][j]比较，其实就是和现在dp[j]比较
                if dp[j] and s1[i - 1] == s3[i + j - 1]:
                    dp[j] = True
                #同理，这里原先是和dp[i][j - 1]比较，其实就是和现在dp[j - 1]比较
                elif dp[j - 1] and s2[j - 1] == s3[i + j - 1]:
                    dp[j] = True
                #否则无法交替组成
                else:
                    dp[j] = False
    return dp[-1]