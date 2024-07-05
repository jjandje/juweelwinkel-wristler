<?php

enum ConditionEnum: string
{
	case NEW = 'NEW';
	case UNWORN = 'UNWORN';
	case VERY_GOOD = 'VERY_GOOD';
	case GOOD = 'GOOD';
	case FAIR = 'FAIR';
	case POOR = 'POOR';
	case INCOMPLETE = 'INCOMPLETE';
}