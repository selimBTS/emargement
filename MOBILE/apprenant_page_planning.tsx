import React, { useState } from 'react';
import { View, Text, StyleSheet, TouchableOpacity, Image, FlatList } from 'react-native';
import { Calendar } from 'react-native-calendars';

export default function ApprenantPagePlanning() {
  const [selectedDate, setSelectedDate] = useState('2025-02-17');

  const courses = {
    '2025-02-17': [
      { id: 1, title: 'Anglais', time: '07h15 - 08h00' },
      { id: 2, title: 'Math', time: '17h15 - 18h00' }
    ],
    '2025-02-18': [
      { id: 3, title: 'Histoire', time: '08h15 - 09h15' }
    ]
  };

  const renderCourse = ({ item }) => (
    <View style={styles.courseCard}>
      <Text style={styles.courseTitle}>{item.title}</Text>
      <Text style={styles.courseTime}>{item.time}</Text>
    </View>
  );

  return (
    <View style={styles.container}>
      <View style={styles.header}>
        <View style={styles.avatar}><Text style={styles.avatarText}>AK</Text></View>
        <Image source={require('../assets/gefor-logo.png')} style={styles.logo} />
      </View>

      <Text style={styles.pageTitle}>Planning</Text>

      <Calendar
        onDayPress={day => setSelectedDate(day.dateString)}
        markedDates={{ [selectedDate]: { selected: true, selectedColor: '#E85421' } }}
        theme={{
          selectedDayBackgroundColor: '#E85421',
          todayTextColor: '#E85421',
          arrowColor: '#E85421',
        }}
      />

      <Text style={styles.subTitle}>{formatDate(selectedDate)} ({courses[selectedDate]?.length || 0})</Text>

      <FlatList
        data={courses[selectedDate] || []}
        keyExtractor={item => item.id.toString()}
        renderItem={renderCourse}
        contentContainerStyle={{ paddingBottom: 20 }}
      />

      <View style={styles.footer}>
        <TouchableOpacity><Text style={styles.footerItem}>🏠\nAccueil</Text></TouchableOpacity>
        <TouchableOpacity><Text style={styles.footerItem}>📅\nPlanning</Text></TouchableOpacity>
        <TouchableOpacity><Text style={styles.footerItem}>👤\nProfil</Text></TouchableOpacity>
      </View>
    </View>
  );
}

function formatDate(dateString) {
  const date = new Date(dateString);
  return date.toLocaleDateString('fr-FR', { day: 'numeric', month: 'long', year: 'numeric' });
}

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: '#F1F3F5', paddingTop: 40, paddingHorizontal: 20 },
  header: { flexDirection: 'row', justifyContent: 'space-between', alignItems: 'center', marginBottom: 10 },
  avatar: { backgroundColor: '#E85421', width: 40, height: 40, borderRadius: 20, justifyContent: 'center', alignItems: 'center' },
  avatarText: { color: 'white', fontWeight: 'bold' },
  logo: { width: 100, height: 30, resizeMode: 'contain' },
  pageTitle: { fontWeight: 'bold', fontSize: 18, marginBottom: 15, color: '#0E1E5B' },
  subTitle: { marginVertical: 10, fontWeight: 'bold', color: '#212529' },
  courseCard: { backgroundColor: '#fff', padding: 15, borderRadius: 12, marginBottom: 10, elevation: 2 },
  courseTitle: { fontWeight: 'bold', fontSize: 14 },
  courseTime: { color: '#6C757D', marginTop: 4 },
  footer: { flexDirection: 'row', justifyContent: 'space-around', paddingVertical: 10, borderTopWidth: 1, borderColor: '#ccc', backgroundColor: '#fff' },
  footerItem: { textAlign: 'center', fontSize: 12, color: '#212529' }
});
