"""
64 最小路径和
给定一个包含非负整数的 m x n 网格，请找出一条从左上角到右下角的路径，使得路径上的数字总和为最小。

说明：每次只能向下或者向右移动一步。

示例:

输入:
[
  [1,3,1],
  [1,5,1],
  [4,2,1]
]
输出: 7
解释: 因为路径 1→3→1→1→1 的总和最小。
"""


class Solution:
    def minPathSum(self, grid):
        """
        :type grid: List[List[int]]
        :rtype: int
        """
        if grid == [[]]:
            return 0
        dp = grid
        m = len(grid)
        n = len(grid[0][:])
        for i in range(m):
            for j in range(n):
                if i == 0:
                    if j != 0:
                        dp[i][j] = dp[i][j - 1] + grid[i][j]
                elif j == 0:
                    if i != 0:
                        dp[i][j] = dp[i - 1][j] + grid[i][j]
                else:
                    #要么从左边走过来，要么从上面走过来，求出最小的路径和
                    dp[i][j] = grid[i][j] + min(dp[i][j - 1],dp[i - 1][j])
        return dp[-1][-1]