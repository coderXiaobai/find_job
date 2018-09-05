'''
8.字符串转整数(atoi)
实现atoi，将字符串转为整数。

在找到第一个非空字符之前，需要移除掉字符串中的空格字符。如果第一个非空字符是正号或负号，选取该符号，并将其与后面尽可能多的连续的数字
组合起来，这部分字符即为整数的值。如果第一个非空字符是数字，则直接将其与之后连续的数字字符组合起来，形成整数。

字符串可以在形成整数的字符后面包括多余的字符，这些字符可以被忽略，它们对于函数没有影响。

当字符串中的第一个非空字符序列不是个有效的整数；或字符串为空；或字符串仅包含空白字符时，则不进行转换。

若函数不能执行有效的转换，返回0。

说明：

假设我们的环境只能存储32位有符号整数，其数值范围是[−2 ^ 31, 2 ^ 31 − 1]。如果数值超过可表示的范围，则返回
INT_MAX(2 ^ 31 − 1) 或 INT_MIN(−2 ^ 31) 。
'''

class Solution:
    def str2num(self, str1, opt):
        """
        :type str1: str
        :type opt: str
        :rtype: int
        """
        result = 0
        str_num = {
            "0": 0,
            "1": 1,
            "2": 2,
            "3": 3,
            "4": 4,
            "5": 5,
            "6": 6,
            "7": 7,
            "8": 8,
            "9": 9,
        }
        i = 0
        for each in str1[::-1]:
            result += str_num[each] * (10 ** i)
            if result >= 2 ** 31:
                if opt == "+":
                    return (2 ** 31) - 1
                else:
                    return -(2 ** 31)
            i += 1
        return result if opt == "+" else -result

    def myAtoi(self, str1):
        """
        :type str1: str
        :rtype: int
        """
        # 移除首尾的空格
        str1 = str1.strip()
        # 移除空格后为空则返回0
        if str1 == "":
            return 0
        # 数字字符串列表
        digit = [str(i) for i in range(10)]
        opts = ["+", "-"]
        opt = "+"
        s = ""
        # 第一个非空字符是操作符
        if str1[0] in opts:
            opt = str1[0]
            str1 = str1[1:]
        # 第一个非空字符不是字符串也不是数字则不转化
        elif str1[0] not in digit:
            return 0
        # 否则去除空格和操作符之后第一个字符是数字
        for each in str1:
            if each in digit:
                s += each
            else:
                break
        if s == "":
            return 0
        return self.str2num(s, opt)