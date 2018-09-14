'''
300. 求最长上升子序列
给定一个无序的整数数组，找到其中最长上升子序列的长度。

示例:

输入: [10,9,2,5,3,7,101,18]
输出: 4
解释: 最长的上升子序列是 [2,3,7,101]，它的长度是 4。
说明:
可能会有多种最长上升子序列的组合，你只需要输出对应的长度即可。
你算法的时间复杂度应该为 O(n ^ 2) 。
进阶: 你能将算法的时间复杂度降低到 O(n log n) 吗?
'''
class Solution:
    #O(n ^ 2)解法，很慢
    def lengthOfLIS(self, nums):
        """
        :type nums: List[int]
        :rtype: int
        """
        if len(nums) < 1:
            return 0
        dp = [1] * len(nums)
        result = 1
        for i in range(1,len(nums)):
            #求dp[i]，遍历i之前的所有数
            for j in range(i - 1,-1,-1):
                #如果nums[j]小于nums[i]，那么找到i之前的dp[j]中保存的最大的那个递增子序列的长度，再加一，就是dp[i]
                if nums[j] < nums[i]:
                    dp[i] = dp[i] if dp[i] > dp[j] + 1 else dp[j] + 1
            result = result if result > dp[i] else dp[i]
        return result
