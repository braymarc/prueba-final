# Generated by Django 3.0.7 on 2020-08-16 01:01

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('modelos', '0005_auto_20200815_1818'),
    ]

    operations = [
        migrations.AddField(
            model_name='cliente',
            name='token',
            field=models.TextField(default='', max_length=75),
        ),
    ]